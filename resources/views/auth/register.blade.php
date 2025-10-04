<x-guest-layout>
    <div class="max-w-4xl">

        {{-- Header --}}
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-3xl shadow-2xl mb-6 transform hover:rotate-6 transition-transform duration-300">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                    </path>
                </svg>
            </div>

            <h2 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Baru</h2>
            <p class="text-gray-600">Daftar untuk memulai menggunakan layanan kami</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <form method="POST" action="{{ route('register') }}" class="px-8 py-8 space-y-4">
                @csrf

                {{-- Name --}}
                <div>
                    <x-input-label for="name" :value="__('Name')" class="mb-2" />
                    <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus
                        autocomplete="name" placeholder="Nama lengkap Anda"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 outline-none" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-sm" />
                </div>

                {{-- Email --}}
                <div>
                    <x-input-label for="email" :value="__('Email')" class="mb-2" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required
                        autocomplete="username" placeholder="nama@email.com"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                </div>

                {{-- Password --}}
                <div>
                    <x-input-label for="password" :value="__('Password')" class="mb-2" />
                    <x-text-input id="password" type="password" name="password" required autocomplete="new-password"
                        placeholder="Minimal 8 karakter"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                </div>

                {{-- Confirm Password --}}
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="mb-2" />
                    <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password" placeholder="Konfirmasi password Anda"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-green-500 focus:ring-4 focus:ring-green-100 outline-none" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm" />
                </div>

                {{-- Submit Button --}}
                <div>
                    <button type="submit"
                        class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>

            {{-- Footer --}}
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 text-center text-sm">
                <span class="text-gray-600">Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:text-indigo-700 ml-1">
                    Login Sekarang
                </a>
            </div>
        </div>

        {{-- Additional Info --}}
        <p class="mt-6 text-center text-xs text-gray-500">
            Dengan mendaftar, Anda menyetujui <a href="#"
                class="text-indigo-600 hover:text-indigo-700 font-medium">Syarat & Ketentuan</a> dan <a href="#"
                class="text-indigo-600 hover:text-indigo-700 font-medium">Kebijakan Privasi</a>
        </p>

    </div>
</x-guest-layout>
