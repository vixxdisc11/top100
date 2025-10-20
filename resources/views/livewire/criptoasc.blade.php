<div x-data="{ search: '' }" class="bg-gray-900/40 backdrop-blur-sm rounded-2xl border border-gray-800 text-gray-200 p-4">

    <!-- 🔹 Barra de búsqueda + botones -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-6 gap-4">
        <!-- Campo de búsqueda -->
        <div class="flex items-center justify-center w-full md:w-1/2">
            <input
                type="text"
                x-model="search"
                placeholder="🔍 Search cryptocurrency..."
                class="w-full px-5 py-3 rounded-xl bg-gray-800/70 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 placeholder-gray-400 text-gray-100 transition"
            >
            <button
                @click="search = ''"
                x-show="search.length > 0"
                class="ml-3 text-gray-400 hover:text-red-400 transition"
                title="Clear">✕</button>
        </div>
        <div class="flex justify-end mb-4">
    <div class="flex justify-end mb-4">

</div>

</div>

        <!-- 🔹 Botones de filtros (a la derecha) -->

    </div>

    <!-- 🔹 Cabecera de la lista -->
    <div class="hidden md:flex items-center justify-between text-xs uppercase text-gray-400 border-b border-gray-800 pb-2 px-4">
        <div class="w-10 text-left">#</div>
        <div class="flex-1 text-left">Name</div>
        <div class="w-28 text-right">Price</div>
        <div class="w-24 text-right">24h %</div>
        <div class="w-40 text-right">Market Cap</div>
        <div class="w-40 text-right">Volume</div>
    </div>

    <!-- 🔹 Lista -->
    @if (!empty($cryptos) && is_iterable($cryptos))
        <div class="divide-y divide-gray-800">

            @foreach ($cryptos as $index => $coin)
                @if (is_array($coin))
                    <template
                        x-if="search === '' || '{{ strtolower($coin['name']) }}'.includes(search.toLowerCase()) || '{{ strtolower($coin['symbol']) }}'.includes(search.toLowerCase())">
                        <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-800/60 transition cursor-pointer"
                             @click="window.location='{{ route('crypto.detail', ['id' => $coin['id']]) }}'">

                            <!-- # -->
                            <div class="w-10 text-gray-500 font-medium">{{ $index + 1 }}</div>

                            <!-- Nombre + símbolo -->
                            <div class="flex items-center gap-3 flex-1">
                                <img src="{{ $coin['image'] ?? '' }}" alt="{{ $coin['name'] ?? '' }}" class="w-7 h-7 rounded-full">
                                <div class="text-left">
                                    <p class="font-semibold text-gray-100">{{ $coin['name'] ?? 'Unknown' }}</p>
                                    <p class="text-xs uppercase text-gray-400">{{ $coin['symbol'] ?? '' }}</p>
                                </div>
                            </div>

                            <!-- Precio -->
                            <div class="w-28 text-right font-semibold text-indigo-400">
                                €{{ isset($coin['current_price']) ? number_format($coin['current_price'], 2) : 'N/A' }}
                            </div>

                            <!-- % 24h -->
                            <div class="w-24 text-right font-semibold
                                {{ isset($coin['price_change_percentage_24h']) && $coin['price_change_percentage_24h'] > 0 ? 'text-green-400' : 'text-red-400' }}">
                                {{ isset($coin['price_change_percentage_24h']) ? number_format($coin['price_change_percentage_24h'], 2) . '%' : 'N/A' }}
                            </div>

                            <!-- Market Cap -->
                            <div class="w-40 text-right text-gray-300">
                                ${{ isset($coin['market_cap']) ? number_format($coin['market_cap']) : 'N/A' }}
                            </div>

                            <!-- Volumen -->
                            <div class="w-40 text-right text-gray-400">
                                ${{ isset($coin['total_volume']) ? number_format($coin['total_volume']) : 'N/A' }}
                            </div>
                        </div>
                    </template>
                @endif
            @endforeach
        </div>
    @else
        <p class="text-gray-400 text-center mt-8 italic">⚠️ No data available. Please try again later.</p>
    @endif
</div>
