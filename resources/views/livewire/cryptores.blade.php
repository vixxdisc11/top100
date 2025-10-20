<div
    x-data="{
        search: '{{ request('query', '') }}',
        showReversed: false,
        priceOrder: null,
        changeOrder: null // 'asc', 'desc' or null
    }"
    class="bg-gray-900/40 backdrop-blur-sm rounded-2xl border border-gray-800 text-gray-200 p-6 shadow-lg"
>

    <!-- Search Bar + Filter Buttons -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">

        <!-- Search Field -->
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

        <!-- Filter Buttons -->
        <div class="flex flex-wrap justify-center md:justify-end w-full gap-3">

            <!-- Market Cap Toggle -->
            <button
                @click="
                    showReversed = !showReversed;
                    if (showReversed) { priceOrder = null; changeOrder = null; }
                "
                x-text="showReversed ? ' Market Cap ↑' : ' Market Cap ↓'"
                :class="showReversed
                    ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30'
                    : 'bg-gray-800 text-gray-300 hover:bg-indigo-500 hover:text-white'"
                class="px-5 py-2.5 rounded-lg font-semibold text-sm tracking-wide transition duration-300 border border-gray-700 hover:border-indigo-400">
            </button>

            <!-- Price Order Toggle -->
            <button
                @click="
                    if (priceOrder === null) { priceOrder = 'desc'; showReversed = false; }
                    else if (priceOrder === 'desc') { priceOrder = 'asc'; }
                    else { priceOrder = null; }
                "
                x-text="
                    priceOrder === 'desc'
                        ? ' Price ↓'
                        : priceOrder === 'asc'
                            ? ' Price ↑'
                            : ' Price'
                "
                :class="priceOrder
                    ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30'
                    : 'bg-gray-800 text-gray-300 hover:bg-indigo-500 hover:text-white'"
                class="px-5 py-2.5 rounded-lg font-semibold text-sm tracking-wide transition duration-300 border border-gray-700 hover:border-indigo-400">
            </button>

            <!-- 24h % Order Toggle -->
            <button
                @click="
                    if (changeOrder === null) { changeOrder = 'desc'; showReversed = false; }
                    else if (changeOrder === 'desc') { changeOrder = 'asc'; }
                    else { changeOrder = null; }
                "
                x-text="
                    changeOrder === 'desc'
                        ? ' 24h % ↓'
                        : changeOrder === 'asc'
                            ? ' 24h % ↑'
                            : ' 24h %'
                "
                :class="changeOrder
                    ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30'
                    : 'bg-gray-800 text-gray-300 hover:bg-indigo-500 hover:text-white'"
                class="px-5 py-2.5 rounded-lg font-semibold text-sm tracking-wide transition duration-300 border border-gray-700 hover:border-indigo-400">
            </button>
        </div>
    </div>

    <!-- Table Header -->
    <div class="hidden md:flex items-center justify-between text-xs uppercase text-gray-400 border-b border-gray-800 pb-2 px-4">
        <div class="w-10 text-left">#</div>
        <div class="flex-1 text-left">Name</div>
        <div class="w-28 text-right">Price</div>
        <div class="w-24 text-right">24h %</div>
        <div class="w-40 text-right">Market Cap</div>
        <div class="w-40 text-right">Volume</div>
    </div>

    <!-- Dynamic Coin List -->
    <div class="divide-y divide-gray-800 mt-3">

        <!-- Default (Normal) -->
        <template x-if="!showReversed && priceOrder === null && changeOrder === null">
            <div x-transition.opacity.duration.300ms>
                @include('livewire.partials.crypto-list', ['data' => $cryptos])
            </div>
        </template>

        <!-- Market Cap Reversed -->
        <template x-if="showReversed && priceOrder === null && changeOrder === null">
            <div x-transition.opacity.duration.300ms>
                @include('livewire.partials.crypto-list', ['data' => $cryptosReversed])
            </div>
        </template>

        <!-- Price ↓ -->
        <template x-if="priceOrder === 'desc'">
            <div x-transition.opacity.duration.300ms>
                @include('livewire.partials.crypto-list', ['data' => $cryptosPriceDesc])
            </div>
        </template>

        <!-- Price ↑ -->
        <template x-if="priceOrder === 'asc'">
            <div x-transition.opacity.duration.300ms>
                @include('livewire.partials.crypto-list', ['data' => $cryptosPriceAsc])
            </div>
        </template>

        <!-- 24h % ↓ -->
        <template x-if="changeOrder === 'desc'">
            <div x-transition.opacity.duration.300ms>
                @include('livewire.partials.crypto-list', ['data' => $cryptosChangeDesc])
            </div>
        </template>

        <!-- 24h % ↑ -->
        <template x-if="changeOrder === 'asc'">
            <div x-transition.opacity.duration.300ms>
                @include('livewire.partials.crypto-list', ['data' => $cryptosChangeAsc])
            </div>
        </template>

        <!-- Price + Change Combined -->
        <template x-if="(priceOrder !== null) && (changeOrder !== null)">
            <div x-transition.opacity.duration.300ms>
                @include('livewire.partials.crypto-list', ['data' => $cryptosPriceDesc])
                @include('livewire.partials.crypto-list', ['data' => $cryptosChangeAsc])
            </div>
        </template>

        <!-- Price ↓ + 24h % ↓ -->
        <template x-if="priceOrder === 'desc' && changeOrder === 'desc'">
            <div>@include('livewire.partials.crypto-list', ['data' => $cryptosPriceChangeDesc])</div>
        </template>

        <!-- Price ↑ + 24h % ↑ -->
        <template x-if="priceOrder === 'asc' && changeOrder === 'asc'">
            <div>@include('livewire.partials.crypto-list', ['data' => $cryptosPriceChangeAsc])</div>
        </template>

        <!-- Price ↓ + 24h % ↑ -->
        <template x-if="priceOrder === 'desc' && changeOrder === 'asc'">
            <div>@include('livewire.partials.crypto-list', ['data' => $cryptosPriceDescChangeAsc])</div>
        </template>

        <!-- Price ↑ + 24h % ↓ -->
        <template x-if="priceOrder === 'asc' && changeOrder === 'desc'">
            <div>@include('livewire.partials.crypto-list', ['data' => $cryptosPriceAscChangeDesc])</div>
        </template>

    </div>
</div>
