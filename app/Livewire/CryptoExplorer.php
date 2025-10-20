<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CryptoExplorer extends Component
{
    public $cryptos = [];
    public $search = '';
    public $sortField = null; // 'market_cap' o 'price'
    public $sortDirection = 'asc'; // asc o desc

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => null],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function mount()
    {
        $this->fetchCryptos();
    }

    public function updatedSearch()
    {
        $this->fetchCryptos();
    }

    public function sortMarketCapAsc()
    {
        $this->sortField = 'market_cap';
        $this->sortDirection = 'asc';
        $this->fetchCryptos();
    }

    public function sortMarketCapDesc()
    {
        $this->sortField = 'market_cap';
        $this->sortDirection = 'desc';
        $this->fetchCryptos();
    }

    public function sortPriceAsc()
    {
        $this->sortField = 'price';
        $this->sortDirection = 'asc';
        $this->fetchCryptos();
    }

    public function sortPriceDesc()
    {
        $this->sortField = 'price';
        $this->sortDirection = 'desc';
        $this->fetchCryptos();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'sortField', 'sortDirection']);
        $this->fetchCryptos();
    }

    public function fetchCryptos()
    {
        try {
            // 🔹 Llamamos a la API pública de CoinGecko
            $response = Http::get('https://api.coingecko.com/api/v3/coins/markets', [
                'vs_currency' => 'usd',
                'order' => 'market_cap_desc',
                'per_page' => 100,
                'page' => 1,
                'sparkline' => false,
            ]);

            $data = $response->json();

            if (!$data) {
                $this->cryptos = [];
                return;
            }

            // 🔹 Filtrado por búsqueda
            $filtered = collect($data)->filter(function ($coin) {
                if (!$this->search) return true;
                return str_contains(strtolower($coin['name']), strtolower($this->search))
                    || str_contains(strtolower($coin['symbol']), strtolower($this->search));
            });

            // 🔹 Ordenamiento dinámico
            if ($this->sortField) {
                $filtered = $filtered->sortBy(function ($coin) {
                    if ($this->sortField === 'price') return $coin['current_price'];
                    if ($this->sortField === 'market_cap') return $coin['market_cap'];
                }, SORT_REGULAR, $this->sortDirection === 'desc');
            }

            $this->cryptos = $filtered->values()->all();

        } catch (\Exception $e) {
            $this->cryptos = [];
        }
    }

    public function render()
    {
        return view('livewire.crypto-explorer');
    }
}
