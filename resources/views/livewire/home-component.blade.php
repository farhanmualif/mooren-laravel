<div>
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Dashboard</h5>
        </div>
    </div>
    <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
        <div class="col-span-12 lg:col-span-8">
            <div class="grid grid-cols-12 gap-x-5">
                <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-3">
                    <div class="text-center card-body">
                        <div
                            class="flex items-center justify-center mx-auto rounded-full size-14 bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                            <i data-lucide="users-round"></i>
                        </div>
                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $totalUsers }}">0</span>
                        </h5>
                        <p class="text-slate-500 dark:text-zink-200">Total Users</p>
                    </div>
                </div><!--end col-->
                <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-3">
                    <div class="text-center card-body">
                        <div
                            class="flex items-center justify-center mx-auto text-green-500 bg-green-100 rounded-full size-14 dark:bg-green-500/20">
                            <i data-lucide="mountain-snow"></i>
                        </div>
                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $totalGunung }}">0</span>
                        </h5>
                        <p class="text-slate-500 dark:text-zink-200">Total Gunung</p>
                    </div>
                </div><!--end col-->
                <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-3">
                    <div class="text-center card-body">
                        <div
                            class="flex items-center justify-center mx-auto text-purple-500 bg-purple-100 rounded-full size-14 dark:bg-purple-500/20">
                            <i data-lucide="package"></i>
                        </div>
                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $totalTiket }}">0</span>
                        </h5>
                        <p class="text-slate-500 dark:text-zink-200">Total Pesanan</p>
                    </div>
                </div><!--end col-->
                <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-3">
                    <div class="text-center card-body">
                        <div
                            class="flex items-center justify-center mx-auto text-red-500 bg-red-100 rounded-full size-14 dark:bg-red-500/20">
                            <i data-lucide="wallet-2"></i>
                        </div>
                        <h5 class="mt-4 mb-2">
                            @php
                                $formattedAmount = number_format($totalPenghasilan, 0, ',', '.');
                            @endphp
                            Rp
                            <span class="counter-value" data-target="{{ str_replace('.', '', $formattedAmount) }}">
                                Rp 0
                            </span>
                        </h5>
                        <p class="text-slate-500 dark:text-zink-200">Total Penghasilan</p>
                    </div>
                </div>
                <div class="relative col-span-12 overflow-hidden card 2xl:col-span-12 bg-slate-900">
                    <div class="relative card-body">
                        <div class="grid items-center grid-cols-12">
                            <div class="col-span-12 lg:col-span-8 2xl:col-span-7">
                                <h5 class="mb-3 font-normal tracking-wide text-slate-200">Welcome MOREEN ⛰️
                                </h5>
                                <p class="mb-5 text-slate-400">MOREEN adalah aplikasi pemesanan tiket pendakian gunung
                                    yang memudahkan para petualang sejati untuk merencanakan perjalanan mereka dengan
                                    lebih mudah dan praktis.
                                </p>
                            </div>
                            <div
                                class="hidden col-span-12 2xl:col-span-3 lg:col-span-2 lg:col-start-11 2xl:col-start-10 lg:block">
                                <img src="{{ asset('assets/images/mountain.png') }}" alt=""
                                    class="h-40 ltr:2xl:ml-auto rtl:2xl:mr-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 card 2xl:col-span-4">
            <div class="card-body">
                <div class="flex items-center mb-3">
                    <h6 class="grow text-15">Users</h6>
                </div>
                <ul class="divide-y divide-slate-200 dark:divide-zink-500">
                    @foreach ($users as $user)
                        <li class="flex items-center gap-3 py-2 first:pt-0 last:pb-0">
                            <div class="w-8 h-8 rounded-full shrink-0 bg-slate-100 dark:bg-zink-600">
                                <img src="{{ asset('assets/images/avatar-2.png') }}" alt=""
                                    class="w-8 h-8 rounded-full">
                            </div>
                            <div class="grow">
                                <h6 class="font-medium">{{ $user->name }}</h6>
                                <p class="text-slate-500 dark:text-zink-200">{{ $user->email }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
