<!DOCTYPE html>
<html lang="en" x-data="scrollSections()" x-init="init()" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CryptoTop100</title>
     <link rel="icon" type="image/png" href="{{ asset('img/crylog2.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<!-- 👇 Añadimos scroll tipo diapositiva -->
<body class="bg-gradient-to-b from-[#0f0f11] to-[#1a1c20] text-gray-100 overflow-x-hidden snap-y snap-mandatory h-screen overflow-scroll">

    <!-- 🔹 Navbar -->
    <nav class="flex justify-between items-center px-8 py-4 bg-[#141518]/90 backdrop-blur-md shadow-sm fixed w-full z-50">
        <a href="/" class="flex items-center gap-3">
        <img src="{{ asset('img/crylog2.png') }}"
             alt="CryptoTop100 Logo"
             class="w-10 h-10 object-contain hover:scale-110 transition-transform duration-300">
        <span class="font-semibold text-lg text-indigo-600 tracking-tight">CryptoTop100</span>
    </a>
        <div class="flex items-center gap-4 text-gray-400">
            <a href="#section1"
               :class="currentSection === 1 ? 'text-indigo-400 font-semibold' : 'hover:text-indigo-400 transition'">
               Search
            </a>
            <a href="#section2"
               :class="currentSection === 2 ? 'text-indigo-400 font-semibold' : 'hover:text-indigo-400 transition'">
               Top 100
            </a>
            <a href="#section3"
               :class="currentSection === 3 ? 'text-indigo-400 font-semibold' : 'hover:text-indigo-400 transition'">
               Profile
            </a>
        </div>
    </nav>

    <!-- 🔹 Indicador lateral -->
    <nav class="fixed right-6 top-1/2 -translate-y-1/2 z-50 flex flex-col gap-3">
        <template x-for="i in 3" :key="i">
            <button
                @click="scrollToSection(i)"
                :class="currentSection === i ? 'bg-indigo-400 scale-125 ring-2 ring-indigo-300' : 'bg-gray-600'"
                class="w-3 h-3 rounded-full transition-all duration-300 hover:scale-125"></button>
        </template>
    </nav>

    <!-- 🔹 Sección 1 — Buscador -->
    <section id="section1" data-section="1"
         class="snap-start h-screen flex flex-col justify-center items-center text-center px-6 relative overflow-hidden">

    <!-- 🎥 Video de fondo -->
    <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
        <source src="{{ asset('4K_210.mp4') }}" type="video/mp4">
    </video>

    <!-- 🔳 Capa oscura -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/10 to-black/80"></div>

    <div class="relative z-10 max-w-2xl">
        <h1 class="text-5xl md:text-6xl font-extrabold mb-6 tracking-tight text-white">Discover Crypto Assets</h1>

        <!-- 🔹 Formulario funcional -->
        <div class="flex w-full max-w-md mx-auto focus:ring-indigo-500">
            <form action="{{ route('crypto.search') }}" method="GET" class="flex w-full">
                <input
                    type="text"
                    name="query"
                    placeholder="Search cryptocurrency..."
                    class="flex-1 px-4 py-3 rounded-l-lg bg-gray-800 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-200"
                    required>
                <button
                    type="submit"
                    class="px-5 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-r-lg font-semibold transition">
                    Search
                </button>
            </form>
        </div>
    </div>
</section>

<section id="section2"
    data-section="2"
    class="snap-start min-h-[90vh] flex flex-col justify-start items-center bg-[#0f0f11] text-gray-100 relative overflow-hidden px-6"
    x-data="{ activeComponent: 'cryptores' }">

    <div class="relative z-10 w-full max-w-7xl py-16">
        <h2 class="text-4xl md:text-5xl font-bold mb-8 text-center text-white">Top 100 Cryptocurrencies</h2>
            <!-- 🔹 Main Content -->
            <div class="flex-1 bg-gray-900/50 backdrop-blur-sm rounded-2xl border border-gray-800 p-6 shadow-xl overflow-y-auto h-[70vh] scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900">

                <!-- Component Descending -->
                <div
                    x-show="activeComponent === 'cryptores'"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="w-full">
                    <livewire:cryptores />
                </div>
            </div>
        </div>
    </div>
</section>







    <!-- 🔹 Sección 3 — Favoritos -->
    <section id="section3" class="h-screen flex flex-col justify-center items-center text-center relative">
    <!-- Fondo decorativo -->
    <div class="absolute inset-0 bg-[url('/images/bg-crypto3.jpg')] bg-cover bg-center opacity-10"></div>

    <div class="relative z-10 max-w-2xl w-full px-6 py-10 bg-gray-900/40 backdrop-blur-lg border border-gray-800 rounded-2xl shadow-2xl">
        <h2 class="text-4xl font-bold mb-6 text-white">Your Profile</h2>
        <p class="text-gray-400 mb-10">Manage your account and session.</p>

        <!-- 🧑 Información del usuario -->
        @auth
            <div class="bg-gray-800/60 border border-gray-700 rounded-xl p-6 mb-8">
                <p class="text-lg text-gray-300 mb-2"> <strong>Name:</strong> {{ Auth::user()->name }}</p>
                <p class="text-lg text-gray-400"> <strong>Email:</strong> {{ Auth::user()->email }}</p>
            </div>

            <!-- 🚪 Botón de Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl shadow-lg shadow-red-500/30 transition duration-300 focus:outline-none focus:ring-2 focus:ring-red-400">
                     Log Out
                </button>
            </form>
        @else
            <!-- Si no hay sesión -->
            <p class="text-gray-400 italic mb-6">You are not logged in.</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}"
                   class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition">
                    Log In
                </a>
                <a href="{{ route('register') }}"
                   class="px-5 py-2 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-lg transition">
                    Register
                </a>
            </div>
        @endauth
    </div>
</section>



    @livewireScripts

    <!-- ✅ Script para detectar la sección actual -->
    <script>
        function scrollSections() {
            return {
                currentSection: 1,
                init() {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                this.currentSection = parseInt(entry.target.dataset.section);
                            }
                        });
                    }, { threshold: 0.5 });
                    document.querySelectorAll('section').forEach(sec => observer.observe(sec));
                },
                scrollToSection(i) {
                    const target = document.querySelector(`#section${i}`);
                    if (target) target.scrollIntoView({ behavior: 'smooth' });
                }
            }
        }
    </script>
</body>
</html>
