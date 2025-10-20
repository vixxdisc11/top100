@if (!empty($data) && is_iterable($data))
    @foreach ($data as $index => $coin)
        @if (is_array($coin))
            <template
                x-if="search === '' ||
                       '{{ strtolower($coin['name']) }}'.includes(search.toLowerCase()) ||
                       '{{ strtolower($coin['symbol']) }}'.includes(search.toLowerCase())">

                <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-800/60 transition cursor-pointer group relative"
                     @click="window.location='{{ route('crypto.detail', ['id' => $coin['id']]) }}'">

                    <!-- # -->
                    <div class="w-10 text-gray-500 font-medium">{{ $index + 1 }}</div>

                    <!-- Name + Symbol -->
                    <div class="flex items-center gap-3 flex-1">
                        <img src="{{ $coin['image'] ?? '' }}" alt="{{ $coin['name'] ?? '' }}" class="w-7 h-7 rounded-full">
                        <div class="text-left">
                            <p class="font-semibold text-gray-100">{{ $coin['name'] ?? 'Unknown' }}</p>
                            <p class="text-xs uppercase text-gray-400">{{ $coin['symbol'] ?? '' }}</p>
                        </div>
                    </div>

                    <!-- Price -->
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

                    <!-- Volume -->
                    <div class="w-40 text-right text-gray-400">
                        ${{ isset($coin['total_volume']) ? number_format($coin['total_volume']) : 'N/A' }}
                    </div>


                </div>
            </template>
        @endif
    @endforeach
@else
    <p class="text-gray-400 text-center mt-8 italic">⚠️ No data available. Please try again later.</p>
@endif
