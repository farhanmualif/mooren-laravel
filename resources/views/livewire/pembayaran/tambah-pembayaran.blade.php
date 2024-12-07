<div>
    <div class="card">
        <div class="card-body">
            <h6 class="mb-4 text-15 border-b border-slate-200 pb-4 dark:border-navy-500">Buat Pembayaran</h6>

            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                    <div class="xl:col-span-4">
                        <label for="kodeInput" class="inline-block mb-2 text-base font-medium">KODE TIKET</label>
                        <input type="text" wire:model.lazy="kode_tiket" id="kodeInput"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="PTGHBQAW" required="">
                        <p class="mt-1 text-sm text-slate-400">Masukkan KODE TIKET dan tekan enter.</p>
                    </div>
                    <div class="xl:col-span-12">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                            <div class="xl:col-span-4">
                                <label for="nameInput" class="inline-block mb-2 text-base font-medium">Nama</label>
                                <input type="text" value="{{ $user }}" id="nameInput"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Nama" disabled="" required="">
                            </div>
                            <div class="xl:col-span-4">
                                <label for="gunungInput" class="inline-block mb-2 text-base font-medium">Nama
                                    Gunung</label>
                                <input type="text" value="{{ $nama_gunung }}" id="gunungInput"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Gunung" disabled="" required="">
                            </div>
                            <div class="xl:col-span-4">
                                <label for="tgl_masuk" class="inline-block mb-2 text-base font-medium">Tgl Masuk</label>
                                <input type="text" value="{{ $tgl_masuk }}" id="tgl_masuk"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Gunung" disabled="" required="">
                            </div>
                            <div class="xl:col-span-4">
                                <label for="tgl_keluar" class="inline-block mb-2 text-base font-medium">Tgl
                                    Keluar</label>
                                <input type="text" value="{{ $tgl_keluar }}" id="tgl_keluar"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Gunung" disabled="" required="">
                            </div>
                            <!-- Input Total Harga (Hanya Ditampilkan) -->
                            <div class="xl:col-span-4">
                                <label for="totalHarga" class="inline-block mb-2 text-base font-medium">Total
                                    Harga</label>
                                <input type="text" value="{{ $total_harga }}" id="totalHarga"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Total Harga" disabled="">
                            </div>

                        </div>
                    </div>
                    <!-- Input Tanggal Pembayaran -->
                    <div class="xl:col-span-4">
                        <label for="createDateInput" class="inline-block mb-2 text-base font-medium">Tanggal
                            Pembayaran</label>
                        <input type="date" id="createDateInput" wire:model="tgl_pembayaran"
                            class="form-input border-slate-200 focus:outline-none focus:border-custom-500"
                            placeholder="Select date">
                    </div>
                    <div class="xl:col-span-12">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">

                            <div class="xl:col-span-6">
                                <label for="metodeSelect" class="inline-block mb-2 text-base font-medium">Metode
                                    Pembayaran</label>
                                <select wire:model="metode_pembayaran" id="metodeSelect"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices="" data-choices-search-false="">
                                    <option value="">Pilih Metode</option>
                                    <option value="COD">COD</option>
                                </select>
                            </div>
                            <div class="xl:col-span-6">
                                <label for="statusSelect" class="inline-block mb-2 text-base font-medium">Status</label>
                                <select wire:model="status" id="statusSelect"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices="" data-choices-search-false="">
                                    <option value="">Pilih Status</option>
                                    <option value="Sudah Dibayar">Sudah Dibayar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <button type="reset" class="btn text-red-500">Reset</button>
                    <button type="submit" class="btn bg-custom-500 text-white">Buat Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
