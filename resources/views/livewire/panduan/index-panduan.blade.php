<div>
    <div class="col-span-12 md:order-8 2xl:col-span-9 card">
        <div class="card-body">
            <div class="grid grid-cols-1 gap-5 mb-5 xl:grid-cols-2">
                <div>
                    <div class="relative xl:w-3/6">
                        <input type="text"
                            class="w-full ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                            placeholder="Search for ..." autocomplete="off" wire:model="search"
                            wire:keydown.enter="searchGunung">

                        <!-- Gunakan wire:ignore pada ikon -->
                        <div
                            class="inline-block absolute ltr:left-2.5 rtl:right-2.5 top-2 text-slate-500 dark:text-zink-200">
                            <i class="ri-search-2-line"></i>
                        </div>
                    </div>
                </div>
                <div class="ltr:md:text-end rtl:md:text-start">
                    <a href="{{ route('tambah-panduan') }}"
                        class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 add-btn">
                        <i class="align-bottom ri-add-line me-1"></i> Tambah Panduan</a>

                    <a href="{{ route('edit-gambar-tiket') }}"
                        class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 add-btn">
                        <i class="align-bottom ri-image-edit-line me-1"></i> Ubah Gambar Menu Tiket</a>
                </div>
            </div>
            @if (session()->has('message'))
            <div id="notification"
                class="relative p-3 pr-12 text-sm text-green-500 border border-transparent rounded-md bg-green-50 dark:bg-green-400/20">
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

            <div class="-mx-5 my-5 overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead
                        class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                        <tr>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500 w-10">
                                <div class="flex items-center h-full">
                                    <input id="productsCheckAll"
                                        class="size-4 cursor-pointer bg-white border border-slate-200 checked:bg-none dark:bg-zink-700 dark:border-zink-500 rounded-sm appearance-none arrow-none relative after:absolute after:content-['\eb7b'] after:top-0 after:left-0 after:font-remix after:leading-none after:opacity-0 checked:after:opacity-100 after:text-custom-500 checked:border-custom-500 dark:after:text-custom-500 dark:checked:border-custom-800"
                                        type="checkbox">
                                </div>
                            </th>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                ID</th>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                JUDUL PANDUAN</th>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                GAMBAR</th>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                INFORMASI</th>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = ($panduan->currentPage() - 1) * $panduan->perPage() + 1;
                        @endphp
                        @foreach ($panduan as $data)
                        <tr>
                            <td
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                <div class="flex items-center h-full">
                                    <input id="productsCheck1"
                                        class="size-4 cursor-pointer bg-white border border-slate-200 checked:bg-none dark:bg-zink-700 dark:border-zink-500 rounded-sm appearance-none arrow-none relative after:absolute after:content-['\eb7b'] after:top-0 after:left-0 after:font-remix after:leading-none after:opacity-0 checked:after:opacity-100 after:text-custom-500 checked:border-custom-500 dark:after:text-custom-500 dark:checked:border-custom-800"
                                        type="checkbox">
                                </div>
                            </td>
                            <td
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                {{ $no++ }}
                            </td>
                            <td
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 text-slate-500">
                                {{ $data->title }}
                            </td>
                            <td
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                <div class="bg-green-100 rounded-full size-10 dark:bg-green-500/20 shrink-0">
                                    <img src="{{ $data->gambar }}" alt="" class="h-10 rounded-full">
                                </div>
                            </td>
                            <td
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 text-slate-500">
                                {{ \Illuminate\Support\Str::limit(strip_tags($data->informasi), 50, '...') }}
                            </td>
                            <td
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                <div class="flex gap-2">
                                    <a href="{{ route('edit-panduan', $data->id) }}"
                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 dark:bg-zink-600 dark:text-zink-200 text-slate-500 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/20"><i
                                            class="ri-pencil-line text-lg"></i></a>
                                    <a href="{{ route('hapus-panduan', $data->id) }}"
                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 dark:bg-zink-600 dark:text-zink-200 text-slate-500 hover:text-red-500 dark:hover:text-red-500 hover:bg-red-100 dark:hover:bg-red-500/20"><i
                                            class="ri-delete-bin-line text-lg"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col items-center mt-5 md:flex-row">
                <div class="flex justify-center mt-5">
                    {{ $panduan->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
