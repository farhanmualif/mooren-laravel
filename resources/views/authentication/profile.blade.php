<x-app-layout>
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Profile</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="{{ route('home') }}" class="text-slate-400 dark:text-zink-200">Dashboard</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Profile
            </li>
        </ul>
    </div>
    <div class="grid grid-cols-12 gap-4 transition-all duration-[.25s] sm:gap-5 lg:gap-6">
        <div class="col-span-12">
            <div class="card">
                <div class="flex items-center justify-between border-b border-slate-200 p-4 dark:border-navy-500">
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        Account Setting
                    </h2>
                </div>
                <div class="p-4 sm:p-5">
                    @if (session()->has('message'))
                        <div id="notification"
                            class="relative p-3 pr-12 mb-4 text-sm text-green-500 border border-transparent rounded-md bg-green-50 dark:bg-green-400/20">
                            <!-- Tombol 'X' untuk menutup notifikasi -->
                            <button onclick="closeNotification()"
                                class="absolute top-0 bottom-0 right-0 p-3 text-green-200 transition hover:text-green-500 dark:text-green-400/50 dark:hover:text-green-500">
                                <i data-lucide="x" class="h-5"></i>
                            </button>
                            <span class="font-bold">Message:</span> {{ session('message') }}
                        </div>

                        <!-- Tambahkan JavaScript untuk menutup notifikasi -->
                        <script>
                            function closeNotification() {
                                document.getElementById('notification').remove();
                            }
                        </script>
                    @endif
                    <form action="{{ route('profile-update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="block">
                                <span>User Name</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter name" type="text" name="name"
                                        value="{{ old('name', $admin->name) }}">
                                    <span
                                        class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="fa-regular fa-user text-base"></i>
                                    </span>
                                </span>
                            </label>

                            <label class="block">
                                <span>Email Address</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter email address" type="email" name="email"
                                        value="{{ old('email', $admin->email) }}">
                                    <span
                                        class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="fa-regular fa-envelope text-base"></i>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="my-5 h-px  bg-slate-200 dark:bg-navy-500"></div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="block">
                                <span>New Password</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="@error('password') ring-danger @enderror form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="New Password" type="password" name="password">
                                    <span
                                        class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </span>
                            </label>

                            <label class="block">
                                <span>Confirm Password</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="@error('password_confirmation') ring-danger @enderror form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Confirm Password" type="password" name="password_confirmation">
                                    <span
                                        class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="text-white mt-4 rounded-full btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
