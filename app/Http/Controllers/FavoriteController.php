<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'coin_id' => 'required|string',
        ]);

        $user = Auth::user();

        $favorite = Favorite::where('user_id', $user->id)
                            ->where('coin_id', $request->coin_id)
                            ->first();

        if ($favorite) {
            // Si ya existe → eliminarlo (quitar de favoritos)
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // Si no existe → añadirlo
            Favorite::create([
                'user_id' => $user->id,
                'coin_id' => $request->coin_id,
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    public function list()
    {
        $user = Auth::user();
        $favorites = $user->favorites()->pluck('coin_id');
        return response()->json($favorites);
    }
}
