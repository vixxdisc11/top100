<section id="section3"
         class="snap-start h-screen flex flex-col justify-center items-center text-center relative">

    <div class="absolute inset-0 bg-[url('/images/bg-crypto3.jpg')] bg-cover bg-center opacity-10"></div>

    <div class="relative z-10 max-w-3xl px-6">
        <h2 class="text-4xl md:text-5xl font-bold mb-6 text-white">Your Favorite Coins</h2>
        <p class="text-gray-400 mb-10">Save and manage your favorite cryptocurrencies easily.</p>

        @if (count($favorites) > 0)
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 text-gray-100">
                @foreach ($favorites as $coin)
                    <div class="bg-gray-900/70 p-4 rounded-xl hover:bg-gray-800 transition relative">
                        <img src="{{ $coin['image'] ?? '' }}" class="w-12 h-12 mx-auto mb-2" alt="{{ $coin['name'] }}">
                        <p class="font-semibold">{{ $coin['name'] ?? '' }}</p>
                        <p class="text-sm text-gray-400">€{{ number_format($coin['current_price'] ?? 0, 2) }}</p>

                        <button
                            wire:click="removeFavorite('{{ $coin['id'] }}')"
                            class="absolute top-2 right-2 text-red-400 hover:text-red-600 transition"
                            title="Remove from favorites">✕
                        </button>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400 italic">No favorites yet.</p>
        @endif
    </div>
</section>
