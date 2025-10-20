<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CryptoTop100 - Register</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/crylog2.png') }}">

    <!-- Tailwind / Vite -->
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-b from-[#0f0f11] to-[#1a1c20] text-gray-100 flex items-center justify-center min-h-screen relative overflow-hidden">

    <!-- Background video -->
    <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover opacity-20">
        <source src="{{ asset('zzz.mp4') }}" type="video/mp4">
    </video>

    <!-- Main container -->
    <div class="relative z-10 w-full max-w-md bg-gray-900/40 backdrop-blur-xl rounded-2xl border border-gray-800 p-8 shadow-2xl">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('img/crylog2.png') }}" alt="CryptoTop100 Logo"
                 class="w-28 h-28 object-contain drop-shadow-md hover:scale-105 transition-transform duration-300">
        </div>

        <!-- Title -->
        <h2 class="text-center text-3xl font-bold text-white mb-2 tracking-tight">
            Create your account
        </h2>
        <p class="text-center text-sm text-gray-400 mb-8">
            Already have an account?
            <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition">
                Log in here
            </a>
        </p>

        <!-- Functional Laravel Breeze + Livewire Form -->
        <div class="flex flex-col gap-6">
            <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <form method="POST" wire:submit="register" class="flex flex-col gap-6">
                @csrf

                <!-- Name -->
                <flux:input
                    wire:model="name"
                    :label="__('Name')"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                    :placeholder="__('Full name')"
                />

                <!-- Email Address -->
                <flux:input
                    wire:model="email"
                    :label="__('Email address')"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                />

                <!-- Password -->
                <flux:input
                    wire:model="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Password')"
                    viewable
                />

                <!-- Confirm Password -->
                <flux:input
                    wire:model="password_confirmation"
                    :label="__('Confirm password')"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Confirm password')"
                    viewable
                />

                <div class="flex items-center justify-end">
                    <flux:button type="submit" variant="primary" class="w-full">
                        {{ __('Create account') }}
                    </flux:button>
                </div>
            </form>

            <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
                <span>{{ __('Already have an account?') }}</span>
                <flux:link :href="route('login')" wire:navigate class="text-indigo-400 hover:text-indigo-300">
                    {{ __('Log in') }}
                </flux:link>
            </div>
        </div>
    </div>

</body>
</html>
