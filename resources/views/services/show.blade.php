<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ Auth::user()->hasRole('owner') ? __('Service Orders') : __('My Service') }}
            </h2>
        </div>
    </x-slot>

    {{-- Konten utama --}}
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @role('buyer')
                    {{-- Notifikasi sukses --}}
                    @if (session('success'))
                        <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
                            class="text-green-500 mt-2 transition duration-500">
                            {{ session('success') }}
                        </p>
                    @endif
                @endrole


                {{-- Informasi biaya & tanggal --}}
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-5 flex-wrap">
                    <div class="flex-1 min-w-[150px]">
                        <p class="text-sm md:text-base text-slate-500">Biaya Perbaikan</p>

                        @role('owner')
                            {{-- Form edit biaya --}}
                            <form action="{{ route('services.update_cost', $service->id) }}" method="POST"
                                class="flex flex-wrap items-center gap-2 mt-1">
                                @csrf
                                @method('PUT')
                                <input type="number" name="repair_costs"
                                    value="{{ old('repair_costs', $service->repair_costs ?? 0) }}"
                                    class="border rounded px-3 py-1 w-32" min="0" step="1000">
                                <button type="submit"
                                    class="py-1.5 px-3 rounded bg-blue-600 text-white hover:bg-blue-700 text-sm">
                                    Simpan / Edit
                                </button>
                            </form>
                        @else
                            {{-- Buyer hanya bisa lihat --}}
                            <h3 class="text-lg md:text-xl font-bold text-indigo-950 mt-1">
                                @if ($service->repair_costs)
                                    Rp. {{ number_format($service->repair_costs, 0, ',', '.') }}
                                @else
                                    <span class="text-gray-400 italic">Belum diinput</span>
                                @endif
                            </h3>
                        @endrole
                    </div>

                    <div class="flex-1 min-w-[150px] mt-2 md:mt-0">
                        <p class="text-sm md:text-base text-slate-500">Tanggal</p>
                        <p class="text-lg md:text-xl font-bold text-indigo-950 mt-1">
                            {{ $service->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-2 mt-2 md:mt-0">
                        {{-- Status Konfirmasi --}}
                        @php
                            $statusColors = [
                                'Menunggu Konfirmasi' => 'bg-orange-500',
                                'Diterima' => 'bg-blue-500',
                                'Ditolak' => 'bg-red-500',
                            ];
                        @endphp
                        <span
                            class="py-2 px-4 rounded-full text-white text-sm md:text-base font-bold {{ $statusColors[$service->status_confirmation] }}">
                            {{ $service->status_confirmation }}
                        </span>

                        {{-- Status Perbaikan hanya tampil jika tidak Ditolak --}}
                        @if ($service->status_confirmation !== 'Ditolak')
                            @php
                                $repairColors = [
                                    'Menunggu Antrian' => 'bg-gray-500',
                                    'Proses Perbaikan' => 'bg-yellow-500',
                                    'Selesai' => 'bg-green-500',
                                ];
                            @endphp
                            <span
                                class="py-2 px-4 rounded-full text-white text-sm md:text-base font-bold {{ $repairColors[$service->status_repair] }}">
                                {{ $service->status_repair }}
                            </span>
                        @endif
                    </div>
                </div>


                <hr class="my-3">

                {{-- Detail Items --}}
                <h3 class="text-xl font-bold text-indigo-950 mb-4">Items</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- Kiri: Informasi Pelanggan & Perangkat --}}
                    <div
                        class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        {{-- Header dengan Nomor Antrian --}}
                        <div class="flex items-center justify-between mb-6 pb-4 border-b-2 border-blue-100">
                            <h3 class="text-lg font-bold text-gray-800">Informasi Service</h3>
                            <div
                                class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-lg shadow-md">
                                <span class="text-xs font-medium uppercase tracking-wide">No. Antrian</span>
                                <p class="text-2xl font-bold">
                                    {{ str_pad($service->queue_number, 3, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>

                        {{-- Informasi Detail --}}
                        <div class="space-y-4">
                            {{-- Nama Pelanggan --}}
                            <div
                                class="flex items-start gap-3 p-3 bg-white rounded-lg  hover:bg-blue-50 transition-colors duration-200">
                                <div
                                    class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Nama
                                        Pelanggan</p>
                                    <p class="text-gray-900 font-semibold">{{ $service->customer_name }}</p>
                                </div>
                            </div>

                            {{-- Tipe Smartphone --}}
                            <div
                                class="flex items-start gap-3 p-3 bg-white rounded-lg hover:bg-purple-50 transition-colors duration-200">
                                <div
                                    class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Tipe
                                        Smartphone</p>
                                    <p class="text-gray-900 font-semibold">{{ $service->phone_type }}</p>
                                </div>
                            </div>

                            {{-- Kerusakan --}}
                            <div
                                class="flex items-start gap-3 p-3 bg-white rounded-lg hover:bg-red-50 transition-colors duration-200">
                                <div
                                    class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Kerusakan
                                    </p>
                                    <p class="text-gray-900 font-semibold">{{ $service->damage_description }}</p>
                                </div>
                            </div>

                            {{-- Notes --}}
                            <div
                                class="flex items-start gap-3 p-3 bg-white rounded-lg hover:bg-green-50 transition-colors duration-200">
                                <div
                                    class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Catatan
                                    </p>
                                    <p
                                        class="text-gray-900 font-semibold {{ $service->notes ? '' : 'text-gray-400 italic' }}">
                                        {{ $service->notes ?? 'Tidak ada catatan' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kanan: Bukti Nota --}}
                    <div class="flex flex-col gap-3 items-center bg-gray-50 p-5 rounded-lg hover:shadow-lg transition-shadow duration-300 w-full md:w-auto"
                        x-data="{ preview: null }">

                        <div class="mb-4">
                            <h3 class="text-lg md:text-xl font-bold text-indigo-950 text-center">Bukti Nota</h3>
                            <h3 class="text-lg md:text-lg font-bold text-gray-500 text-center">No Rekening:
                                0000-0000-0000</h3>
                        </div>

                        @role('buyer')
                            @if (!$service->attachment)
                                {{-- Form upload nota --}}
                                <form action="{{ route('services.uploadNota', $service->id) }}" method="POST"
                                    enctype="multipart/form-data" class="flex flex-col gap-2 w-full max-w-xs md:max-w-sm">
                                    @csrf
                                    <input type="file" name="attachment" required
                                        class="border rounded px-2 py-1 w-full"
                                        @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">

                                    {{-- Preview sebelum submit --}}
                                    <template x-if="preview">
                                        <img :src="preview" alt="Preview Nota"
                                            class="w-full max-w-xs md:max-w-sm h-auto object-contain border rounded-md shadow mt-2" />
                                    </template>

                                    <button type="submit"
                                        class="py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700 mt-2 w-full">
                                        Upload Nota
                                    </button>
                                </form>
                            @else
                                {{-- Tampilkan nota yang sudah diupload --}}
                                <img src="{{ asset('storage/' . $service->attachment) }}"
                                    alt="Bukti {{ $service->customer_name }}"
                                    class="w-full max-w-xs md:max-w-sm h-auto object-contain border rounded-md shadow" />
                            @endif
                        @endrole

                        @role('owner')
                            @if ($service->attachment)
                                {{-- Owner hanya bisa lihat --}}
                                <img src="{{ asset('storage/' . $service->attachment) }}"
                                    alt="Bukti {{ $service->customer_name }}"
                                    class="w-full max-w-xs md:max-w-sm h-auto object-contain border rounded-md shadow" />
                            @else
                                <p class="text-gray-500 text-center">Buyer belum mengirimkan nota.</p>
                            @endif
                        @endrole

                    </div>
                </div>

                <hr class="my-3">

                @role('owner')
                    <form method="POST" action="{{ route('services.update', $service->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Jika masih menunggu konfirmasi --}}
                        @if ($service->status_confirmation === 'Menunggu Konfirmasi')
                            <button type="submit" name="action" value="Diterima"
                                class="py-3 px-5 rounded-full text-white bg-blue-600 hover:bg-blue-700 cursor-pointer">
                                Setujui Pesanan
                            </button>

                            {{-- Tombol tolak --}}
                            <button type="button"
                                onclick="document.getElementById('reject-form').classList.toggle('hidden')"
                                class="py-3 px-5 rounded-full text-white bg-red-600 hover:bg-red-700 cursor-pointer">
                                Tolak Pesanan
                            </button>

                            {{-- Form rejection notes (hidden by default) --}}
                            <div id="reject-form" class="hidden mt-3 flex flex-col gap-2">
                                <textarea name="rejection_notes" placeholder="Isi alasan penolakan..." class="border rounded-md p-2 w-full"></textarea>
                                <button type="submit" name="action" value="Ditolak"
                                    class="py-2 px-4 rounded-full text-white bg-red-700 hover:bg-red-800 cursor-pointer">
                                    Kirim Penolakan
                                </button>
                            </div>
                        @elseif($service->status_confirmation === 'Diterima' && $service->status_repair !== 'Selesai')
                            {{-- Tombol mulai perbaikan --}}
                            @if ($service->status_repair === 'Menunggu Antrian')
                                <button type="submit" name="action" value="Mulai Perbaikan"
                                    class="py-3 px-5 rounded-full text-white bg-yellow-600 hover:bg-yellow-700 cursor-pointer">
                                    Mulai Perbaikan
                                </button>
                            @elseif($service->status_repair === 'Proses Perbaikan')
                                <button type="submit" name="action" value="Selesai Perbaikan"
                                    class="py-3 px-5 rounded-full text-white bg-green-600 hover:bg-green-700 cursor-pointer">
                                    Tandai Selesai
                                </button>
                            @endif
                        @elseif($service->status_confirmation === 'Ditolak')
                            <p class="text-red-500 font-semibold">Ditolak: {{ $service->rejection_notes ?? '-' }}</p>
                        @endif
                    </form>
                @endrole
                @role('buyer')
                    <a href="https://wa.me/+6287881388173" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 group">

                        {{-- WhatsApp Icon --}}
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                        </div>

                        {{-- Text --}}
                        <span class="text-base">Hubungi Admin</span>

                        {{-- Arrow Icon --}}
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>
