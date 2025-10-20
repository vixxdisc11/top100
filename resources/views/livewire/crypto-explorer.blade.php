<div
    x-data="{ openFilters: false, search: @entangle('search').live }"
    class="relative flex w-full bg-gray-900/40 backdrop-blur-sm rounded-2xl border border-gray-800 text-gray-200 h-[80vh] overflow-hidden">

    <!-- 🔹 SIDEBAR DE FILTROS -->
    <div
        x-show="openFilters"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="-translate-x-full opacity-0"
        class="absolute top-0 left-0 h-full w-64 bg-[#141518]/95 border-r border-gray-800 backdrop-blur-md shadow-lg z-20 flex flex-col justify-between">

        <div class="p-6 mt-14 space-y-8 text-left">
            <h2 class="text-lg font-semibold text-indigo-400 border-b border-gray-700 pb-2">Filters</h2>

            <!-- 🔸 Market Cap -->
            <div>
                <h3 class="text-xs uppercase text-gray-400 mb-3 tracking-wider">Market Cap</h3>
                <div class="flex flex-col gap-2">
                    <button
                        wire:click="sortMarketCapAsc"
                        class="w-full px-4 py-2 rounded-lg bg-[#1b1c20]/80 hover:bg-indigo-600 hover:text-white text-sm border border-gray-700 hover:border-indigo-500 transition-all duration-300">
                        Sort Ascending ↑
                    </button>
                    <button
                        wire:click="sortMarketCapDesc"
                        class="w-full px-4 py-2 rounded-lg bg-[#1b1c20]/80 hover:bg-indigo-600 hover:text-white text-sm border border-gray-700 hover:border-indigo-500 transition-all duration-300">
                        Sort Descending ↓
                    </button>
                </div>
            </div>

            <!-- 🔸 Price -->
            <div>
                <h3 class="text-xs uppercase text-gray-400 mb-3 tracking-wider">Price</h3>
                <div class="flex flex-col gap-2">
                    <button
                        wire:click="sortPriceAsc"
                        class="w-full px-4 py-2 rounded-lg bg-[#1b1c20]/80 hover:bg-indigo-600 hover:text-white text-sm border border-gray-700 hover:border-indigo-500 transition-all duration-300">
                        Sort Ascending ↑
                    </button>
                    <button
                        wire:click="sortPriceDesc"
                        class="w-full px-4 py-2 rounded-lg bg-[#1b1c20]/80 hover:bg-indigo-600 hover:text-white text-sm border border-gray-700 hover:border-indigo-500 transition-all duration-300">
                        Sort Descending ↓
                    </button>
                </div>
            </div>

            <!-- 🔸 Reset -->
            <div>
                <button
                    wire:click="resetFilters"
                    class="w-full px-4 py-2 mt-4 rounded-lg bg-gray-700 hover:bg-gray-600 text-sm text-gray-200 border border-gray-700 transition-all duration-300">
                    Reset Filters
                </button>
            </div>
        </div>

        <!-- 🔸 Botón de cerrar -->
        <div class="p-4 border-t border-gray-800 bg-[#141518]/40">
            <button
                @click="openFilters = false"
                class="w-full px-4 py-2 bg-gray-800 hover:bg-gray-700 rounded-lg text-gray-300 text-sm transition">
                Close
            </button>
        </div>
    </div>

    <!-- 🔹 CONTENEDOR PRINCIPAL -->
    <div class="flex-1 relative p-8 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900">

        <!-- ✅ Botón abrir filtros (siempre visible y fijo) -->
        <button
            @click="openFilters = true"
            x-show="!openFilters"
            x-transition
            class="fixed top-6 right-6 z-30 flex items-center gap-2 px-4 py-2 bg-gray-900/80 border border-gray-700 rounded-xl hover:bg-gray-800 transition-all duration-300 shadow-lg backdrop-blur-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M6 12h12m-9 8h6" />
            </svg>
            <span class="text-sm text-gray-200 font-medium">Filters</span>
        </button>

        <!-- 🔹 Input de búsqueda -->
        <div class="relative flex items-center justify-center mb-8 w-full md:w-2/3 mx-auto mt-4">
            <input
                type="text"
                x-model="search"
                placeholder="🔍 Search cryptocurrency..."
                class="w-full px-5 py-3 rounded-xl bg-gray-800/70 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 placeholder-gray-400 text-gray-100 transition pr-10"
            >

            <button
                x-show="search.length > 0"
                @click="search = ''"
                type="button"
                class="absolute right-3 text-gray-400 hover:text-indigo-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- 🔹 Lista de criptos -->
        @if (!empty($cryptos))
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($cryptos as $index => $coin)
                    <a href="{{ route('crypto.detail', ['id' => $coin['id']]) }}"
                       class="group relative bg-gray-800/60 hover:bg-gray-800 hover:shadow-lg border border-gray-700 rounded-2xl p-5 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">

                        <div class="absolute top-2 left-2 bg-gray-900/70 border border-gray-700 rounded-full w-7 h-7 flex items-center justify-center text-xs font-semibold text-indigo-400 group-hover:text-white transition">
                            {{ $index + 1 }}
                        </div>

                        <div class="flex items-center gap-3 mb-3 mt-3">
                            <div class="relative">
                                <img src="{{ $coin['image'] ?? '' }}" alt="{{ $coin['name'] ?? '' }}" class="w-10 h-10 rounded-full border border-gray-700">
                                <span class="absolute -bottom-1 -right-1 bg-indigo-500/90 text-[10px] px-1.5 py-0.5 rounded-full uppercase text-white font-semibold">
                                    {{ $coin['symbol'] ?? '' }}
                                </span>
                            </div>
                            <div class="text-left">
                                <h2 class="font-semibold text-lg text-white group-hover:text-indigo-400 transition">
                                    {{ $coin['name'] ?? 'Unknown' }}
                                </h2>
                            </div>
                        </div>

                        <div class="text-sm text-gray-300">
                            <p class="mb-1">
                                💲
                                <span class="font-semibold text-indigo-400">
                                    {{ isset($coin['current_price']) ? number_format($coin['current_price'], 2) : 'N/A' }}
                                </span>
                            </p>
                            <p class="text-xs text-gray-400">
                                Market Cap:
                                <span class="font-semibold text-gray-300">
                                    ${{ isset($coin['market_cap']) ? number_format($coin['market_cap']) : 'N/A' }}
                                </span>
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-400 text-center mt-8 italic">⚠️ No data available. Please try again later.</p>
        @endif
    </div>
</div>
