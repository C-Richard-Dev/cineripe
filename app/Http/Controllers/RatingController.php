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
        ], [
            'rating.required' => 'A avaliação é obrigatória.',
            'rating.numeric' => 'A avaliação deve ser um número.',
            'rating.min' => 'A avaliação mínima é 0.5.',
            'rating.max' => 'A avaliação máxima é 10.',
            'comment.string' => 'O comentário deve ser um texto.',
            'comment.max' => 'O comentário não pode exceder 1000 caracteres.',
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


    public function update(Request $request, $rating){
        $data = $request->validate([
            'rating' => 'required|numeric|min:0.5|max:10',
            'comment' => 'nullable|string|max:1000',
        ], [
            'rating.required' => 'A avaliação é obrigatória.',
            'rating.numeric' => 'A avaliação deve ser um número.',
            'rating.min' => 'A avaliação mínima é 0.5.',
            'rating.max' => 'A avaliação máxima é 10.',
            'comment.string' => 'O comentário deve ser um texto.',
            'comment.max' => 'O comentário não pode exceder 1000 caracteres.',
        ]);
        $rating = Rating::findOrFail($rating);
        if ($rating->user !== Auth::id()){
            return redirect()->back()->with('error', 'Você não tem permissão para editar esse comentário!');
        }
        try{
            $rating->update([
                'rating'  => $data['rating'],
                'comment'  => $data['comment'],
            ]);
            return redirect()->back()->with('success', 'Avaliação atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ops! Ocorreu um erro ao atualizar sua avaliação: ' . $e->getMessage());
        }
    }



    public function destroy($rating){
        $rating = Rating::findOrFail($rating);
        if ($rating->user !== Auth::id()){
            return redirect()->back()->with('error', 'Você não tem permissão para apagar esse comentário!');
        }
        try{
            $rating->delete();
            return redirect()->back()->with('success', 'Avaliação removida com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ops! Ocorreu um erro ao remover sua avaliação: ' . $e->getMessage());
        }
    }
}
