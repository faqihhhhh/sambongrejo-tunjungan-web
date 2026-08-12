<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-blora-green-dark">Selamat Datang</h2>
        <p class="text-sm text-gray-500 mt-1">Silakan masuk dengan akun admin Anda.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" class="text-gray-700 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-blora-green focus:ring-blora-green rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <x-input-label for="password" value="Password" class="text-gray-700 font-semibold" />

            <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-blora-green focus:ring-blora-green rounded-lg shadow-sm"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-5 flex justify-between items-center">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blora-green shadow-sm focus:ring-blora-green" name="remember">
                <span class="ms-2 text-sm text-gray-600 select-none">Ingat saya</span>
            </label>
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-blora-green hover:bg-blora-green-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blora-green transition-all transform hover:-translate-y-0.5">
                Masuk
            </button>
        </div>
        
        @if (Route::has('password.request'))
            <div class="mt-6 text-center">
                <a class="underline text-sm text-gray-500 hover:text-blora-green transition-colors" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>
