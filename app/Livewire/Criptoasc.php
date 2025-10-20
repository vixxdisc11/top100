<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Criptoasc extends Component
{
    public $cryptos = [];
    public $search = '';

    public function mount()
    {
        $this->fetchCryptos();
    }

    public function fetchCryptos()
    {
        try {
            $response = Http::get('https://api.coingecko.com/api/v3/coins/markets', [
                'vs_currency' => 'eur',
                'order' => 'market_cap_asc', // 👈 orden correcto ascendente
                'per_page' => 100,
                'page' => 1,
                'sparkline' => false,
            ]);

            if ($response->successful()) {
                $this->cryptos = $response->json();
            } else {
                $this->cryptos = [];
            }
        } catch (\Throwable $e) {
            $this->cryptos = [];
        }
    }

    public function render()
    {
        $list = collect($this->cryptos ?? [])
            ->filter(fn($coin) =>
                isset($coin['name']) &&
                str_contains(strtolower($coin['name']), strtolower($this->search))
            )
            ->map(function ($coin) {
                return [
                    'id' => $coin['id'] ?? null,
                    'name' => $coin['name'] ?? null,
                    'symbol' => $coin['symbol'] ?? null,
                    'image' => $coin['image'] ?? null,
                    'current_price' => $coin['current_price'] ?? null,
                    'market_cap' => $coin['market_cap'] ?? null,
                    'price_change_percentage_24h' => $coin['price_change_percentage_24h'] ?? null,
                    'total_volume' => $coin['total_volume'] ?? null,
                ];
            })
            ->values()
            ->all();

        return view('livewire.criptoasc', [
            'cryptos' => $list,
        ]);
    }
}
