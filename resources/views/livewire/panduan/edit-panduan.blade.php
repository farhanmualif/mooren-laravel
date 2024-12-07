<div>
    <div class="card">
        <div class="card-body">
            <h6 class="mb-4 text-15 border-b border-slate-200 pb-4 dark:border-navy-500">Edit Panduan</h6>

            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                    <div class="xl:col-span-6">
                        <label for="title" class="inline-block mb-2 text-base font-medium">Judul Panduan</label>
                        <input type="text" id="title" wire:model="title" class="form-input"
                            placeholder="Judul Panduan" required>
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="lg:col-span-2 xl:col-span-6">
                        <label for="gambar" class="inline-block mb-2 text-base font-medium">Gambar Panduan</label>
                        <input type="file" wire:model="gambar" name="gambar" id="gambar" class="form-input">

                        @if ($gambar)
                            <div class="mt-2">
                                <p class="text-sm text-slate-400">Preview Gambar Baru:</p>
                                <img src="{{ $gambar->temporaryUrl() }}" alt="Preview Gambar" class="h-24">
                            </div>
                        @elseif($gambarLama)
                            <div class="mt-2">
                                <p class="text-sm text-slate-400">Gambar Lama:</p>
                                <img src="{{ $gambarLama }}" alt="Gambar Lama" class="h-24">
                            </div>
                        @endif

                        @error('gambar')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="lg:col-span-2 xl:col-span-12">
                        <label for="informasi" class="inline-block mb-2 text-base font-medium">Informasi</label>
                        <textarea wire:model="informasi" id="informasi" class="form-input border-slate-200" rows="15"
                            placeholder="Informasi panduan"></textarea>
                        @error('informasi')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="reset" class="btn text-red-500">Reset</button>
                    <button type="submit" class="btn bg-custom-500 text-white">Edit Panduan</button>
                </div>
            </form>
        </div>
    </div>
</div>
