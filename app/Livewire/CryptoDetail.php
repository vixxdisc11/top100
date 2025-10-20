<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request; 

class CryptoDetail extends Component
{
    public $coin = null;
    public $coinId = null;



    public function mount($id = null)
{
    $this->coinId = $id ?? end(\Illuminate\Support\Facades\Request::segments());
    $this->loadCoin();
}



    public function loadCoin()
    {
        try {
            $response = Http::get("https://api.coingecko.com/api/v3/coins/{$this->coinId}");

            if ($response->successful()) {
                $data = $response->json();

                $this->coin = [
                    'id' => $data['id'] ?? null,
                    'name' => $data['name'] ?? 'Unknown',
                    'symbol' => strtoupper($data['symbol'] ?? ''),
                    'image' => $data['image']['large'] ?? '',
                    'price' => $data['market_data']['current_price']['usd'] ?? 0,
                    'market_cap' => $data['market_data']['market_cap']['usd'] ?? 0,
                    'rank' => $data['market_cap_rank'] ?? 0,
                    'description' => strip_tags($data['description']['en'] ?? ''),
                ];
            } else {
                $this->coin = [];
            }
        } catch (\Throwable $e) {
            $this->coin = [];
        }
    }

    // public function render()
    // {
    //      dd([
    //         'coinId' => $this->coinId,
    //         'coin' => $this->coin,
    //     ]);
    //     return view('livewire.crypto-detail', [
    //     'coin' => $this->coin,
    //     'coinId' => $this->coinId,
    // ]);
    // }
    public function render()
{
    $coin = $this->coin;
    $coinId = $this->coinId;

    // Renderiza la vista directamente como Blade (no como Livewire)
    echo view('livewire.crypto-detail', compact('coin', 'coinId'))->render();
    exit;
}
}
