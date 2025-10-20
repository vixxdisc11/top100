<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Cryptores extends Component
{
    public $cryptos = [];
    public $search = '';
    public $orderDirection = 'desc'; // 'desc' o 'asc'

    public function mount()
    {
        $this->fetchCryptos();
    }

   
    public function fetchCryptos()
    {
        try {
            $response = Http::get('https://api.coingecko.com/api/v3/coins/markets', [
                'vs_currency' => 'eur',
                'order' => 'market_cap_desc',
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

   
    private function reverseArray($array)
    {
        $reversed = [];
        $count = count($array);

        for ($i = $count - 1; $i >= 0; $i--) {
            $reversed[] = $array[$i];
        }

        return $reversed;
    }

    
    private function sortByPriceDesc($array)
    {
        usort($array, fn($a, $b) => ($b['current_price'] ?? 0) <=> ($a['current_price'] ?? 0));
        return $array;
    }

   
    private function sortByPriceAsc($array)
    {
        usort($array, fn($a, $b) => ($a['current_price'] ?? 0) <=> ($b['current_price'] ?? 0));
        return $array;
    }

   
    private function sortByChangeDesc($array)
    {
        usort($array, fn($a, $b) => ($b['price_change_percentage_24h'] ?? 0) <=> ($a['price_change_percentage_24h'] ?? 0));
        return $array;
    }

   
    private function sortByChangeAsc($array)
    {
        usort($array, fn($a, $b) => ($a['price_change_percentage_24h'] ?? 0) <=> ($b['price_change_percentage_24h'] ?? 0));
        return $array;
    }

  
    private function multiSort($array, $options = [])
    {
       
        usort($array, function ($a, $b) use ($options) {
            foreach ($options as $key => $direction) {
                $aVal = $key === 'price' ? ($a['current_price'] ?? 0) : ($a['price_change_percentage_24h'] ?? 0);
                $bVal = $key === 'price' ? ($b['current_price'] ?? 0) : ($b['price_change_percentage_24h'] ?? 0);

                if ($aVal == $bVal) continue; // si son iguales, pasa al siguiente criterio

                if ($direction === 'desc') {
                    return $bVal <=> $aVal;
                } else {
                    return $aVal <=> $bVal;
                }
            }
            return 0;
        });

        return $array;
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

       
        $reversedList = $this->reverseArray($list);
        $priceDescList = $this->sortByPriceDesc($list);
        $priceAscList = $this->sortByPriceAsc($list);
        $changeDescList = $this->sortByChangeDesc($list);
        $changeAscList = $this->sortByChangeAsc($list);

      
        $multiPriceChangeDesc = $this->multiSort($list, ['price' => 'desc', 'change' => 'desc']);
        $multiPriceChangeAsc = $this->multiSort($list, ['price' => 'asc', 'change' => 'asc']);
        $multiPriceDescChangeAsc = $this->multiSort($list, ['price' => 'desc', 'change' => 'asc']);
        $multiPriceAscChangeDesc = $this->multiSort($list, ['price' => 'asc', 'change' => 'desc']);

        
        return view('livewire.cryptores', [
            'cryptos' => $list, // normal
            'cryptosReversed' => $reversedList,
            'cryptosPriceDesc' => $priceDescList,
            'cryptosPriceAsc' => $priceAscList,
            'cryptosChangeDesc' => $changeDescList,
            'cryptosChangeAsc' => $changeAscList,

            
            'cryptosPriceChangeDesc' => $multiPriceChangeDesc,
            'cryptosPriceChangeAsc' => $multiPriceChangeAsc,
            'cryptosPriceDescChangeAsc' => $multiPriceDescChangeAsc,
            'cryptosPriceAscChangeDesc' => $multiPriceAscChangeDesc,
        ]);
    }
}
