<div>
    <div class="card">
        <div class="card-body">
            <h6 class="mb-4 text-15 border-b border-slate-200 pb-4 dark:border-navy-500">Edit Gunung</h6>

            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                    <!-- Nama Gunung -->
                    <div class="xl:col-span-6">
                        <label for="nama_gunung" class="inline-block mb-2 text-base font-medium">Nama Gunung</label>
                        <input type="text" id="nama_gunung" wire:model="nama_gunung" class="form-input"
                            placeholder="Nama Gunung" required>
                        <p class="mt-1 text-sm text-slate-400">Contoh: Gunung Prau, Gunung Sindoro.</p>
                    </div>

                    <!-- Lokasi -->
                    <div class="xl:col-span-6">
                        <label for="lokasi" class="inline-block mb-2 text-base font-medium">Lokasi</label>
                        <input type="text" id="lokasi" wire:model="lokasi" class="form-input" placeholder="Lokasi"
                            required>
                        <p class="mt-1 text-sm text-slate-400">Contoh: Sleman, Yogyakarta, Magelang.</p>
                    </div>

                    <!-- Tinggi Gunung -->
                    <div class="xl:col-span-6">
                        <label for="tinggi_gunung" class="inline-block mb-2 text-base font-medium">Tinggi Gunung</label>
                        <input type="number" id="tinggi_gunung" wire:model="tinggi_gunung" class="form-input"
                            placeholder="Tinggi Gunung" required>
                        <p class="mt-1 text-sm text-slate-400">Masukkan Angka</p>
                    </div>

                    <!-- Gambar -->
                    <div class="lg:col-span-2 xl:col-span-6">
                        <label for="gambar" class="inline-block mb-2 text-base font-medium">Gambar</label>
                        <input type="file" wire:model="gambar" id="gambar" class="form-input" accept="image/*">

                        <!-- Menampilkan gambar lama jika ada -->
                        <!-- Tampilkan gambar lama hanya jika tidak ada gambar baru yang diinput -->
                        @if ($gambarLama && !$gambar)
                            <img src="{{ $gambarLama }}" alt="Gambar Lama" class="mt-2 h-24">
                        @endif

                        <!-- Preview gambar baru jika ada -->
                        @if ($gambar)
                            <div class="mt-2">
                                <p class="text-sm text-slate-400">Preview Gambar Baru:</p>
                                <img src="{{ $gambar->temporaryUrl() }}" alt="Preview Gambar" class="h-24">
                            </div>
                        @endif

                    </div>

                    <!-- Deskripsi -->
                    <div class="lg:col-span-2 xl:col-span-12">
                        <label for="deskripsi" class="inline-block mb-2 text-base font-medium">Deskripsi</label>
                        <textarea wire:model="deskripsi" id="deskripsi" class="form-input border-slate-200 dark:border-zink-500"
                            placeholder="Deskripsi gunung" rows="20"></textarea>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end gap-2 mt-4">
                    <button type="reset" class="btn text-red-500">Reset</button>
                    <button type="submit" class="btn bg-custom-500 text-white">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
