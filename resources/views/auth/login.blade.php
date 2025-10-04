<x-guest-layout>
    <div
        class="w-full max-w-4xl bg-white dark:bg-gray-800 shadow-2xl rounded-3xl overflow-hidden flex flex-col lg:flex-row">

        {{-- Left Side (Optional Image / Info) --}}
        <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-indigo-600 to-purple-600 items-center justify-center">
            <div class="text-center text-white p-12">
                <h2 class="text-4xl font-bold mb-4">Selamat Datang!</h2>
                <p class="text-lg">Masuk untuk melanjutkan atau daftar jika belum punya akun.</p>
                <svg class="w-32 h-32 mx-auto mt-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
            </div>
        </div>

        {{-- Right Side (Form) --}}
        <div class="w-full lg:w-1/2 p-10">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang Kembali</h2>
                <p class="text-gray-600">Silakan login untuk melanjutkan</p>
            </div>

            {{-- Session Status --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- Login Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Email --}}
                <div>
                    <x-input-label for="email" :value="__('Email')" class="mb-2" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                        placeholder="nama@email.com"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                </div>

                {{-- Password --}}
                <div>
                    <x-input-label for="password" :value="__('Password')" class="mb-2" />
                    <x-text-input id="password" type="password" name="password" required
                        autocomplete="current-password" placeholder="••••••••"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit"
                        class="w-full py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        {{ __('Log in') }}
                    </button>
                </div>

                {{-- Footer --}}
                <div class="text-center text-sm mt-4">
                    <span class="text-gray-600">Belum punya akun?</span>
                    <a href="{{ route('register') }}"
                        class="text-blue-600 font-semibold hover:text-blue-700 ml-1">Daftar Sekarang</a>
                </div>
            </form>
        </div>

    </div>
</x-guest-layout>


{{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif --}}

{{-- <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded-sm dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-xs focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div> --}}
