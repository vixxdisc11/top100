<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $coin['name'] ?? 'Crypto Detail' }} - CryptoTop100</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/crylog2.png') }}">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-b from-[#0f0f11] to-[#1a1c20] text-gray-100 relative overflow-hidden">

    <!-- Background video (Wall Street style) -->
    <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover opacity-10">
        <source src="{{ asset('videos/stock-background.mp4') }}" type="video/mp4">
    </video>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/50 to-black/90"></div>

    <!-- Navbar -->
    <nav class="flex justify-between items-center px-8 py-4 bg-[#141518]/90 backdrop-blur-md shadow-sm fixed top-0 left-0 w-full z-50 border-b border-gray-800">
        <a href="/" class="flex items-center gap-3">
            <img src="{{ asset('img/crylog2.png') }}"
                 alt="CryptoTop100 Logo"
                 class="w-10 h-10 object-contain hover:scale-110 transition-transform duration-300">
            <span class="font-semibold text-lg text-indigo-500 tracking-tight">CryptoTop100</span>
        </a>

        <div class="flex items-center gap-6 text-gray-400 font-medium">
            <a href="/" class="hover:text-indigo-400 transition">Home</a>
            <a href="#section2" class="hover:text-indigo-400 transition">Top 100</a>
            <a href="#section3" class="hover:text-indigo-400 transition">Favorites</a>
        </div>
    </nav>

    <!-- Main content -->
    <main class="relative z-10 flex-grow flex justify-center items-start px-6 pt-28 pb-10 overflow-y-auto">
        @if (!empty($coin))
            <div class="w-full max-w-4xl bg-gray-900/60 backdrop-blur-xl border border-gray-800 rounded-2xl shadow-2xl p-8 overflow-hidden max-h-[85vh] flex flex-col">

                <!-- Header info -->
                <div class="flex flex-col sm:flex-row items-center gap-6 mb-8 flex-shrink-0">
                    <img src="{{ $coin['image'] ?? '' }}" alt="{{ $coin['name'] ?? '' }}"
                         class="w-24 h-24 sm:w-32 sm:h-32 rounded-full shadow-lg border border-gray-700 object-cover">

                    <div class="text-center sm:text-left">
                        <h1 class="text-4xl font-bold text-white tracking-tight">
                            {{ $coin['name'] ?? 'Unknown' }}
                        </h1>
                        <p class="text-indigo-400 uppercase tracking-widest font-semibold text-sm mt-1">
                            {{ $coin['symbol'] ?? '' }}
                        </p>
                        <div class="mt-3">
                            <span class="inline-block px-3 py-1 rounded-lg bg-indigo-500/20 text-indigo-300 font-semibold text-sm">
                                Rank #{{ $coin['rank'] ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid sm:grid-cols-3 gap-6 text-center mb-8 flex-shrink-0">
                    <div class="bg-gray-800/60 border border-gray-700 rounded-xl p-5 hover:bg-gray-800/80 transition">
                        <p class="text-sm text-gray-400 mb-1">Current Price</p>
                        <p class="text-2xl font-bold text-indigo-400">
                            €{{ number_format($coin['price'] ?? 0, 2) }}
                        </p>
                    </div>

                    <div class="bg-gray-800/60 border border-gray-700 rounded-xl p-5 hover:bg-gray-800/80 transition">
                        <p class="text-sm text-gray-400 mb-1">Market Cap</p>
                        <p class="text-2xl font-bold text-green-400">
                            €{{ number_format($coin['market_cap'] ?? 0) }}
                        </p>
                    </div>

                    <div class="bg-gray-800/60 border border-gray-700 rounded-xl p-5 hover:bg-gray-800/80 transition">
                        <p class="text-sm text-gray-400 mb-1">24h Change</p>
                        <p class="text-2xl font-bold {{ ($coin['change_24h'] ?? 0) >= 0 ? 'text-green-400' : 'text-red-400' }}">
                            {{ number_format($coin['change_24h'] ?? 0, 2) }}%
                        </p>
                    </div>
                </div>

                <!-- Description -->
                <div class="flex-grow ">
                    <h2 class="text-2xl font-semibold text-white mb-3 flex items-center gap-2">
                        Description
                    </h2>
                    <div class="bg-gray-800/60 border border-gray-700 rounded-xl p-5 text-gray-300 text-sm leading-relaxed max-h-[45vh] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900">
                        {!! nl2br(e($coin['description'] ?? 'No description available for this cryptocurrency.')) !!}
                    </div>
                </div>

                <!-- Back button -->
                <div class="mt-8 text-center flex-shrink-0">
                    <a href="/"
                       class="inline-block px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-lg font-semibold text-white shadow-md shadow-indigo-500/30 transition">
                        ← Back to Top 100
                    </a>
                </div>
            </div>
        @else
            <p class="text-center text-gray-400 italic mt-20">No cryptocurrency data available.</p>
        @endif
    </main>
</body>
</html>
