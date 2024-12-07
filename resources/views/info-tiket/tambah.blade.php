<x-app-layout>
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <a href="{{ route('info-tiket') }}" class="flex gap-1 items-center">
                <i class="ri-arrow-left-line text-lg"></i>
                <h5 class="text-16">Kembali</h5>
            </a>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="{{ route('home') }}" class="text-slate-400 dark:text-zink-200">Dashboard</a>
            </li>
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                <a href="{{ route('info-tiket') }}" class="text-slate-400 dark:text-zink-200">Daftar Info Tiket</a>
            </li>
            <li class="text-slate-700 dark:text-zink-100">
                Tambah Info Tiket
            </li>
        </ul>
    </div>
    <livewire:info-tiket.tambah-info-tiket />
</x-app-layout>
