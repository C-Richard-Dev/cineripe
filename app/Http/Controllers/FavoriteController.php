<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store (Request $request, int $movie){
        $movieAlreadyAdd = $request->user()->favorites()->where('tmdb_id', $movie)->first();
        if ($movieAlreadyAdd){ // verificando se o filme já
            return redirect()->back()->with('success', 'Opa! Esse filme já está na sua lista de favoritos!');
        }
        try{
            Favorite::create([
                'user_id' => Auth::id(),
                'tmdb_id' => $movie,
            ]);
            return redirect()->back()->with('success', 'O filme foi adicionado á sua lista de favoritos!');
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Ops... Ocorreu um erro ao adicioná-lo á sua lista de favoritos: '.$e->getMessage());
        }
    }


    public function destroy(Request $request, int $movie){
        $favorite = $request->user()->favorites()->where('tmdb_id', $movie)->first();
        $favorite->delete();
        return redirect()->back()->with('success', 'O filme foi removido da sua lista de favoritos com sucesso!');
    }

    
}
