<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favorites()->pluck('tmdb_id');

        $movies = collect();

        foreach ($favorites as $tmdb_id) {
            $response = Http::get("https://api.themoviedb.org/3/movie/{$tmdb_id}", [
                'api_key' => env('TMDB_API_KEY'),
                'language' => 'pt-BR'
            ]);

            if ($response->successful()) {
                $movies->push($response->json());
            }
        }

        return view('pages.favorites.index', compact('movies'));
    }


    public function destroy(Request $request, int $movie){
        $favorite = $request->user()->favorites()->where('tmdb_id', $movie)->first();
        $favorite->delete();
        return redirect()->back()->with('success', 'O filme foi removido da sua lista de favoritos com sucesso!');
    }

    
}
