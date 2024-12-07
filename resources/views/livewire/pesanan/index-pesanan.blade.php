<div>
    <div class="col-span-12 md:order-8 2xl:col-span-9 card">
        <div class="card-body">
            <div class="grid grid-cols-1 gap-5 mb-5 xl:grid-cols-2">
                <div>
                    <div class="relative xl:w-3/6">
                        <input type="text"
                            class="w-full ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                            placeholder="Search for ..." autocomplete="off" wire:model="search"
                            wire:keydown.enter="searchPesanan">

                        <!-- Gunakan wire:ignore pada ikon -->
                        <div
                            class="inline-block absolute ltr:left-2.5 rtl:right-2.5 top-2 text-slate-500 dark:text-zink-200">
                            <i class="ri-search-2-line"></i>
                        </div>
                    </div>
                </div>
            </div>

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
                                KODE TIKET</th>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                USER</th>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                NAMA GUNUNG</th>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                POS MASUK</th>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                POS KELUAR</th>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                TGL MASUK</th>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                TGL KELUAR</th>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                TOTAL HARGA</th>
                            <th
                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                STATUS PEMBAYARAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tiket as $data)
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
                                    class="px-3.5 py-2.5 first:pl-5 text-blue-500 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                    {{ $data->kode_tiket }}
                                </td>
                                <td
                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 text-green-500">
                                    {{ $data->user->name }}</td>
                                <td
                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 text-slate-500">
                                    {{ $data->gunung->nama_gunung }}
                                </td>
                                <td
                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 text-slate-500">
                                    {{ $data->pos_perizinan_masuk }}
                                </td>
                                <td
                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 text-slate-500">
                                    {{ $data->pos_perizinan_keluar }}
                                </td>
                                <td
                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 text-slate-500">
                                    {{ $data->tgl_masuk }}
                                </td>
                                <td
                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 text-slate-500">
                                    {{ $data->tgl_keluar }}
                                </td>
                                <td
                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 text-slate-500">
                                    Rp {{ number_format($data->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zinc-500 status">
                                    <span
                                        class="status px-2.5 py-0.5 inline-block text-xs font-medium rounded border
                                        {{ $data->status_pembayaran == 'pending' ? 'bg-orange-100 text-orange-500 dark:bg-orange-500/20' : '' }}
                                        {{ $data->status_pembayaran == 'success' ? 'bg-green-100 text-green-500 dark:bg-green-500/20' : '' }}
                                        {{ $data->status_pembayaran == 'failed' ? 'bg-red-100 text-red-500 dark:bg-red-500/20' : '' }}">
                                        {{ $data->status_pembayaran }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col items-center mt-5 md:flex-row">
                <div class="flex justify-center mt-5">
                    {{ $tiket->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
