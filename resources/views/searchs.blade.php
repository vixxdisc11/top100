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

<body class="bg-black text-gray-100 overflow-hidden">

    <!-- NAVBAR -->
    <nav class="flex justify-between items-center px-8 py-4 bg-[#141518]/90 backdrop-blur-md shadow-sm fixed top-0 left-0 w-full z-50">
        <a href="/" class="flex items-center gap-3">
            <img src="{{ asset('img/crylog2.png') }}"
                 alt="CryptoTop100 Logo"
                 class="w-10 h-10 object-contain hover:scale-110 transition-transform duration-300">
            <span class="font-semibold text-lg text-indigo-600 tracking-tight">CryptoTop100</span>
        </a>

        <div class="flex items-center gap-4 text-gray-400">
            <a href="/#section1" class="hover:text-indigo-400 transition">Search</a>
            <a href="/#section2" class="hover:text-indigo-400 transition">Top 100</a>
            <a href="/#section3" class="hover:text-indigo-400 transition">Profile</a>
        </div>
    </nav>

    <!-- MAIN SECTION -->
    <section id="section1" data-section="1"
             class="relative flex justify-center items-center text-center overflow-hidden"
             style="height: calc(100vh - 64px); margin-top: 64px;"
             x-data="{ openFilters: false }">

        <!-- Background video -->
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ asset('307615.mp4') }}" type="video/mp4">
        </video>

        <!-- Dark overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/20 to-black/80"></div>

        <!-- COMPONENT CONTAINER -->
        <div class="relative z-10 flex flex-col items-center justify-start w-full h-full overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900 pt-6">
            <div class="w-full max-w-[1100px] px-4">
               @livewire('cryptores', ['search' => request('query')])
            </div>
        </div>
    </section>

    @livewireScripts

</body>
</html>
