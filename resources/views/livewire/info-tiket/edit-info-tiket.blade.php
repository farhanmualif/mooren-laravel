<div>
    <div class="card">
        <div class="card-body">
            <h6 class="mb-4 text-15">Edit Info Tiket</h6>

            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                    <div class="xl:col-span-6 mt-4">
                        <label for="nama_gunung" class="inline-block mb-2 text-base font-medium">Nama Gunung</label>
                        <input type="text" wire:model="nama_gunung" id="nama_gunung"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:text-zink-200"
                            placeholder="Nama Gunung" disabled required>
                    </div>
                    <div class="xl:col-span-12">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                            <div class="xl:col-span-6">
                                <label for="weekdays_lokal" class="inline-block mb-2 text-base font-medium">Weekdays
                                    Lokal</label>
                                <input type="number" wire:model="weekdays_lokal" id="weekdays_lokal"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Harga" required="">
                            </div>
                            <div class="xl:col-span-6">
                                <label for="weekend_lokal" class="inline-block mb-2 text-base font-medium">Weekend
                                    Lokal</label>
                                <input type="number" wire:model="weekend_lokal" id="weekend_lokal"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Harga" required="">
                            </div>
                            <div class="xl:col-span-6">
                                <label for="weekdays_asing" class="inline-block mb-2 text-base font-medium">Weekdays
                                    Asing</label>
                                <input type="number" wire:model="weekdays_asing" id="weekdays_asing"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Harga" required="">
                            </div>
                            <div class="xl:col-span-6">
                                <label for="weekend_asing" class="inline-block mb-2 text-base font-medium">Weekend
                                    Asing</label>
                                <input type="number" wire:model="weekend_asing" id="weekend_asing"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Harga" required="">
                            </div>
                        </div>
                    </div>
                </div><!--end grid-->
                <div class="flex justify-end gap-2 mt-4">
                    <button type="reset" class="btn text-red-500">Reset</button>
                    <button type="submit" class="btn bg-custom-500 text-white">Edit Info Tiket</button>
                </div>
            </form>
        </div>
    </div>
</div>
