<x-guest-layout>
    <!-- Status de Sessão -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Entrar na sua conta</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <!-- <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div> -->
            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
            <!-- Forgot Password and Buttons -->
            <div class="flex items-center justify-between mt-6">
              

                <div class="flex gap-4">
                    <x-primary-button class="px-6 py-2">
                        {{ __('Log in') }}
                    </x-primary-button>
                    <a href="{{ route('auth.github') }}" class="btn btn-outline-primary px-6 py-2">
                        Login com GitHub
                    </a>
                </div>
            </div>
        </form>

        <!-- Link de Registro -->
        <div class="mt-6 text-center">
            <span class="text-sm text-gray-600">Não tem uma conta? </span>
            <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:text-indigo-900">
                Criar conta
            </a>
        </div>
    </div>
</x-guest-layout>
