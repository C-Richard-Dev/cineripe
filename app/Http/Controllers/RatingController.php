<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Função de avaliação de filme (por usuários autenticados)
     */
    public function rate(Request $request, int $movie){
        $data = $request->validate([
            'rating' => 'required|numeric|min:0.5|max:10',
            'comment' => 'nullable|string|max:1000',
        ]);
        // Verifica se o usuário já avaliou este filme
        $rateExists = $request->user()->ratings()->where('tmdb_id', $movie)->first();
        if($rateExists){
            return redirect()->back()->with('error', 'Ops! Você já avaliou este filme!');
        }
        try{
            Rating::create([
                'user_id' => Auth::id(),
                'tmdb_id' => $movie,
                'rating'  => $data['rating'],
                'comment'  => $data['comment'],
            ]);
            return redirect()->back()->with('success', 'Sua avaliação do filme foi publicada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ops! Ocorreu um erro ao salvar sua avaliação: ' . $e->getMessage());
        }
    }
}
