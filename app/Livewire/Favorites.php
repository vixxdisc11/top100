<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use Illuminate\Support\Facades\Http;

class Favorites extends Component
{
    public $favorites = [];

    public function mount()
    {
        $this->loadFavorites();
    }

    public function loadFavorites()
    {
        $user = Auth::user();
        if (!$user) {
            $this->favorites = [];
            return;
        }

        // Recuperamos IDs de monedas guardadas por el usuario
        $favoriteIds = $user->favorites()->pluck('coin_id')->toArray();

        if (empty($favoriteIds)) {
            $this->favorites = [];
            return;
        }

        // Llamamos a la API de CoinGecko para obtener los datos de esas monedas
        try {
            $response = Http::get('https://api.coingecko.com/api/v3/coins/markets', [
                'vs_currency' => 'eur',
                'ids' => implode(',', $favoriteIds),
                'order' => 'market_cap_desc',
                'sparkline' => false,
            ]);

            if ($response->successful()) {
                $this->favorites = $response->json();
            } else {
                $this->favorites = [];
            }
        } catch (\Throwable $e) {
            $this->favorites = [];
        }
    }

    public function removeFavorite($coinId)
    {
        $user = Auth::user();

        Favorite::where('user_id', $user->id)
                ->where('coin_id', $coinId)
                ->delete();

        $this->loadFavorites();
    }

    public function render()
    {
        return view('livewire.favorites');
    }
}
