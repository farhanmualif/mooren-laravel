<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Auth;
use Hash;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('authentication.login');
    }

    /** login account post */
    public function loginAccount(Request $request)
    {
        // Validate login input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the admin in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember_me'))) {
            // Get the authenticated admin
            $admin = Auth::user();

            // Store the admin ID in the session
            $request->session()->put('admin_id', $admin->id);

            // Generate a token (you can customize this part)
            $token = bin2hex(random_bytes(32)); // or use Str::random(60)

            // Store the token in cookies
            Cookie::queue('token', $token, 60 * 24); // 1 day expiration

            // Optional: Store the token in the database or another secure location

            // Set success message
            $request->session()->flash('success', 'Login successful!');

            // Redirect to the intended URL
            return redirect()->intended('/dashboard');
        } else {
            // Redirect back with an error if login failed
            return redirect()->back()->withErrors(['login' => 'Invalid email or password'])->withInput();
        }
    }

    /** Get the admin's profile */
    public function getAdminProfile()
    {
        // Ensure the authenticated user is an admin
        $admin = Auth::guard('web')->user();

        if (!$admin) {
            return redirect()->route('login')->withErrors(['error' => 'Unauthorized access.']);
        }

        // Return a view with the admin profile data
        return view('authentication.profile', ['admin' => $admin]);
    }

    /** Update the admin's profile */
    public function updateProfile(Request $request)
    {
        // Ensure the authenticated user is an admin
        $admin = Auth::guard('web')->user();

        if (!$admin) {
            return redirect()->route('login')->withErrors(['error' => 'Unauthorized access.']);
        }

        // Validate the request data
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update the admin's profile data
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Check if the admin wants to update the password
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }

        // Save the updated admin data
        $admin->save();

        // Flash a success message
        $request->session()->flash('message', 'Profile updated successfully!');

        // Redirect back to the profile page
        return redirect()->route('profile');
    }

    /** logout account */
    public function logout(Request $request)
    {
        // Clear the authentication session
        Auth::logout();

        // Remove the token from cookies
        Cookie::queue(Cookie::forget('token')); // Ensuring the token is cleared

        // Clear the session
        $request->session()->flush();

        // Set a success message
        $request->session()->flash('success', 'You have been logged out.');

        // Redirect to the login page or home
        return redirect('/login'); // or redirect()->intended('/');
    }
}
