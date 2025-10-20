<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
     <link rel="icon" type="image/png" href="{{ asset('img/crylog2.png') }}">
    <title>CryptoTop100</title>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-[#0f0f11] to-[#1a1c20] text-gray-100 relative overflow-hidden">

    <!-- 🎥 Fondo de video -->
    <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover opacity-20">
        <source src="{{ asset('zzz.mp4') }}" type="video/mp4">
    </video>

    <!-- 🔹 Contenedor principal -->
    <div class="relative z-10 w-full max-w-md bg-gray-900/40 backdrop-blur-xl rounded-2xl border border-gray-800 p-8 shadow-2xl">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('img/crylog2.png') }}" alt="CryptoTop100 Logo"
                 class="w-28 h-28 object-contain drop-shadow-md hover:scale-105 transition-transform duration-300">
        </div>

        <!-- Título -->
        <h2 class="text-center text-3xl font-bold text-white mb-2 tracking-tight">
            Log in to your account
        </h2>

        <p class="text-center text-sm text-gray-400 mb-8">
            Or
            <a href="{{ route('register') }}"
               class="text-indigo-400 hover:text-indigo-300 font-medium transition">
                create a new account
            </a>
        </p>

        <!-- 🔐 Formulario funcional de Laravel Breeze + Livewire -->
        <div class="flex flex-col gap-6">

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <form method="POST" wire:submit="login" class="flex flex-col gap-6">
                @csrf

                <!-- Email -->
                <flux:input
                    wire:model="email"
                    :label="__('Email address')"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="email@example.com"
                />

                <!-- Password -->
                <div class="relative">
                    <flux:input
                        wire:model="password"
                        :label="__('Password')"
                        type="password"
                        required
                        autocomplete="current-password"
                        :placeholder="__('Password')"
                        viewable
                    />

                    @if (Route::has('password.request'))
                        <flux:link
                            class="absolute top-0 text-sm end-0 text-indigo-400 hover:text-indigo-300 transition"
                            :href="route('password.request')"
                            wire:navigate>
                            {{ __('Forgot your password?') }}
                        </flux:link>
                    @endif
                </div>

                <!-- Remember Me -->
                <flux:checkbox wire:model="remember" :label="__('Remember me')" />

                <!-- Submit -->
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                        {{ __('Log in') }}
                    </flux:button>
                </div>
            </form>

            <!-- Register link -->
            @if (Route::has('register'))
                <div class="text-sm text-center text-zinc-400">
                    <span>{{ __("Don't have an account?") }}</span>
                    <flux:link :href="route('register')" wire:navigate
                               class="text-indigo-400 hover:text-indigo-300 font-medium">
                        {{ __('Sign up') }}
                    </flux:link>
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>
