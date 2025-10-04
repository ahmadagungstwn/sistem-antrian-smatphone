<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ Auth::user()->hasRole('owner') ? __('Service Orders') : __('My Service') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-2 overflow-hidden p-10 shadow-sm sm:rounded-lg">
                @forelse($services as $service)
                    <div
                        class="item-card bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100">

                        <div class="p-3 sm:p-4 lg:p-5">

                            {{-- Baris Pertama: Nomor Antrian & Nama --}}
                            <div class="flex items-center gap-2 sm:gap-3 lg:gap-6">

                                {{-- Nomor Antrian --}}
                                <div class="flex-shrink-0">
                                    <div
                                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-2 sm:px-3 lg:px-4 py-1.5 sm:py-2 lg:py-3 rounded-lg shadow-md text-center min-w-[60px] sm:min-w-[80px] lg:min-w-[100px]">
                                        <span
                                            class="text-[8px] sm:text-[10px] lg:text-xs font-medium uppercase tracking-wide block">Antrian</span>
                                        <p class="text-base sm:text-xl lg:text-2xl font-bold leading-tight">
                                            {{ str_pad($service->queue_number, 3, '0', STR_PAD_LEFT) }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Nama Pelanggan --}}
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm sm:text-base md:text-lg font-bold text-indigo-950 truncate">
                                        Nama Pelanggan
                                    </h3>
                                    <p class="text-xs sm:text-sm md:text-base text-gray-900 truncate">
                                        {{ $service->customer_name }}
                                    </p>
                                </div>


                                {{-- Status (Hidden di Mobile) --}}
                                @php
                                    $statusColors = [
                                        'Menunggu Konfirmasi' => 'bg-orange-500',
                                        'Diterima' => 'bg-blue-500',
                                        'Ditolak' => 'bg-red-500',
                                    ];
                                @endphp
                                <div class="flex-shrink-0 hidden sm:block">
                                    <span
                                        class="inline-block py-1.5 lg:py-2 px-3 lg:px-4 rounded-full text-white text-xs lg:text-sm font-semibold whitespace-nowrap {{ $statusColors[$service->status_confirmation] }}">
                                        {{ $service->status_confirmation }}
                                    </span>
                                </div>

                                {{-- Action Button (Hidden di Mobile) --}}
                                <div class="flex-shrink-0 hidden sm:block">
                                    <a href="{{ route('services.show', $service->id) }}"
                                        class="inline-flex items-center justify-center gap-2 py-2 lg:py-2.5 px-4 lg:px-6 rounded-lg text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 font-medium text-xs lg:text-sm shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 whitespace-nowrap">
                                        <span>Detail</span>
                                    </a>
                                </div>

                            </div>

                            {{-- Baris Kedua untuk Mobile: Status & Detail Button --}}
                            <div
                                class="sm:hidden mt-2 pt-2 border-t border-gray-100 flex items-center justify-between gap-2">

                                {{-- Status Badge --}}
                                <span
                                    class="inline-block py-1 px-2.5 rounded-full text-white text-[10px] font-semibold {{ $statusColors[$service->status_confirmation] }}">
                                    {{ $service->status_confirmation }}
                                </span>

                                {{-- Detail Button --}}
                                <a href="{{ route('services.show', $service->id) }}"
                                    class="inline-flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-lg text-white bg-gradient-to-r from-indigo-600 to-indigo-700 active:from-indigo-700 active:to-indigo-800 font-medium text-[10px] shadow-md active:scale-95 transition-all duration-200 whitespace-nowrap">
                                    <span>Detail</span>
                                </a>
                            </div>

                        </div>

                    </div>

                    {{-- Spacing --}}
                    <div class="h-2 sm:h-3"></div>

                @empty
                    <div
                        class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 sm:p-8 lg:p-12 text-center border-2 border-dashed border-gray-300 ">
                        <div class="max-w-sm mx-auto">
                            <div
                                class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-base sm:text-lg lg:text-xl font-bold text-gray-700 mb-1 sm:mb-2">Tidak
                                Ada
                                Data Service</h3>
                            <p class="text-gray-500 text-xs sm:text-sm lg:text-base mb-4">Belum ada antrian service yang
                                tersedia</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a href="{{ route('services.create') }}"
                                class="group relative inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-2xl shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">

                                {{-- Animated background --}}
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>

                                {{-- Content --}}
                                <span class="relative flex items-center gap-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-lg">Mulai Service Sekarang</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Script SweetAlert Delete --}}
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target;

            swal({
                title: "Are you sure?",
                text: "Once deleted, this product cannot be restored!",
                icon: "warning",
                buttons: ["Cancel", "Yes, delete it!"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        }
    </script>
</x-app-layout>
