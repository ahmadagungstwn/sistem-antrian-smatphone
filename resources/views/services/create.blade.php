<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buat Antrian Service</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen py-12 px-4">

    <div class="max-w-2xl mx-auto">

        {{-- Header Card --}}
        <div class="bg-white rounded-t-3xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <div class="flex items-center gap-4">
                    {{-- Icon --}}
                    <div
                        class="flex-shrink-0 w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>

                    {{-- Title --}}
                    <div>
                        <h2 class="text-3xl font-bold text-white mb-1">Buat Antrian Perbaikan</h2>
                        <p class="text-blue-100 text-sm">Lengkapi form di bawah untuk membuat antrian service</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-b-3xl shadow-xl p-8">
            <form action="{{ route('services.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Nama Pelanggan --}}
                <div class="group">
                    <label class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Nama Pelanggan
                    </label>
                    <div class="relative">
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                            placeholder="Masukkan nama lengkap"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 pl-12 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 outline-none @error('customer_name') border-red-500 @enderror">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    @error('customer_name')
                        <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Jenis HP --}}
                <div class="group">
                    <label class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Jenis HP
                    </label>
                    <div class="relative">
                        <input type="text" name="phone_type" value="{{ old('phone_type') }}"
                            placeholder="Contoh: iPhone 13 Pro, Samsung Galaxy S21"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 pl-12 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all duration-200 outline-none @error('phone_type') border-red-500 @enderror">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    @error('phone_type')
                        <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Kerusakan --}}
                <div class="group">
                    <label class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                        Deskripsi Kerusakan
                    </label>
                    <div class="relative">
                        <textarea name="damage_description" rows="4" placeholder="Jelaskan kerusakan yang dialami secara detail..."
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 pl-12 focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all duration-200 outline-none resize-none @error('damage_description') border-red-500 @enderror">{{ old('damage_description') }}</textarea>
                        <div class="absolute left-4 top-4">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    @error('damage_description')
                        <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Info Box --}}
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                    <div class="flex gap-3">
                        <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-blue-900 mb-1">Informasi Penting</h4>
                            <p class="text-sm text-blue-700">Pastikan semua data yang Anda masukkan sudah benar. Nomor
                                antrian akan diberikan setelah form berhasil dikirim.</p>
                        </div>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="flex-1 group relative inline-flex items-center justify-center gap-2 px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 overflow-hidden">

                        {{-- Animated background --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>

                        {{-- Content --}}
                        <span class="relative flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Buat Service</span>
                        </span>
                    </button>
                </div>

            </form>
        </div>

    </div>

</body>

</html>
