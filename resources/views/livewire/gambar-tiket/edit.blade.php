<div>
    <div class="max-w-2xl mx-auto p-6">
        <!-- Header -->
        <div class="flex items-center mb-6">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                <h2 class="text-xl font-semibold text-gray-800">Edit Gambar Tiket</h2>
            </div>
        </div>

        <!-- Current Image Display -->
        @if($gambarLama)
        <div class="mb-6">
            <div class="flex justify-center">
                <img src="{{ $gambarLama }}"
                    class="max-w-xs rounded-lg shadow-md"
                    alt="Gambar Saat Ini">
            </div>
        </div>
        @endif

        <!-- Upload Area -->
        <form wire:submit.prevent="update">
            <div class="bg-white rounded-lg border-2 border-dashed border-gray-300 p-8">
                <div class="space-y-6 text-center">
                    <!-- Preview Area -->
                    <div class="flex justify-center">
                        @if ($gambar)
                        <img src="{{ $gambar->temporaryUrl() }}" class="max-w-xs rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300" alt="Preview">
                        @else
                        <div class="flex flex-col items-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="mt-1 text-sm text-gray-500">Drag and drop atau klik untuk memilih file</p>
                        </div>
                        @endif
                    </div>

                    <!-- File Input -->
                    <div class="relative">
                        <input type="file"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            wire:model="gambar"
                            accept="image/*">
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Pilih File
                        </button>
                    </div>

                    @error('gambar')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- File List -->
                    @if($gambar)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <svg class="h-6 w-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-500">{{ $gambar->getClientOriginalName() }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-6 flex justify-center">
                @if($gambar)
                <button type="button"
                    wire:click="update"
                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 add-btn">
                    <i class="align-bottom ri-save-line me-1"></i> Simpan
                </button>
                @endif
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('handleSave', () => {
            alert('Tombol Simpan ditekan!');
        });
    });
</script>