<div>
    <div class="card">
        <div class="card-body">
            <h6 class="mb-4 text-15 border-b border-slate-200 pb-4 dark:border-navy-500">Buat Gunung Baru</h6>

            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                    <div class="xl:col-span-6">
                        <label for="nama_gunung" class="inline-block mb-2 text-base font-medium">Nama Gunung</label>
                        <input type="text" id="nama_gunung" wire:model="nama_gunung" class="form-input"
                            placeholder="Nama Gunung" required>
                        <p class="mt-1 text-sm text-slate-400">Contoh: Gunung Prau, Gunung Sindoro.</p>
                    </div>
                    <div class="xl:col-span-6">
                        <label for="lokasi" class="inline-block mb-2 text-base font-medium">Lokasi</label>
                        <input type="text" id="lokasi" wire:model="lokasi" class="form-input" placeholder="Lokasi"
                            required>
                        <p class="mt-1 text-sm text-slate-400">Contoh: Sleman, Yogyakarta, Magelang.</p>
                    </div>
                    <div class="xl:col-span-6">
                        <label for="tinggi_gunung" class="inline-block mb-2 text-base font-medium">Tinggi Gunung</label>
                        <input type="number" id="tinggi_gunung" wire:model="tinggi_gunung" class="form-input"
                            placeholder="Tinggi Gunung" required>
                        <p class="mt-1 text-sm text-slate-400">Masukkan Angka</p>
                    </div>
                    <div class="lg:col-span-2 xl:col-span-6">
                        <label for="gambar" class="inline-block mb-2 text-base font-medium">Gambar Gunung</label>
                        <input type="file" wire:model="gambar" name="gambar" id="gambar" class="form-input"
                            required>

                        <!-- Tampilkan preview gambar jika ada gambar yang diinputkan -->
                        @if ($gambar)
                            <div class="mt-2">
                                <p class="text-sm text-slate-400">Preview Gambar:</p>
                                <img src="{{ $gambar->temporaryUrl() }}" alt="Preview Gambar" class="h-24">
                            </div>
                        @endif

                        <!-- Menampilkan error jika ada -->
                        @error('gambar')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="lg:col-span-2 xl:col-span-12">
                        <label for="deskripsi" class="inline-block mb-2 text-base font-medium">Deskripsi</label>
                        <textarea wire:model="deskripsi" id="deskripsi" class="form-input border-slate-200 dark:border-zink-500"
                            placeholder="Deskripsi gunung" rows="20"></textarea>
                    </div>
                </div><!--end grid-->
                <div class="flex justify-end gap-2 mt-4">
                    <button type="reset" class="btn text-red-500">Reset</button>
                    <button type="submit" class="btn bg-custom-500 text-white">Buat Gunung</button>
                </div>
            </form>
        </div>
    </div>
</div>
