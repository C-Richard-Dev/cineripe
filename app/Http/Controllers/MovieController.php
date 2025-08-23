<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TmdbService;

class MovieController extends Controller
{
    public function index(Request $request, TmdbService $tmdb)
    {
        $page = (int) $request->integer('page', 1);
        if ($page < 1) $page = 1;
        if ($page > 500) $page = 500; // limite da API

        $data   = $tmdb->trendingMovies('day', $page);
        $movies = $data['results'] ?? [];

        $allMovies = $data['results'] ?? [];

        //Filtra os filmes com nota maior ou igual a 7
        $moreRatedMovies = array_filter($allMovies, function ($allMovies) {
            return isset($allMovies['vote_average']) && $allMovies['vote_average'] >= 7;
        });

        //Chunks de Melhores Avaliados
        $moreRatedMoviesChunks = array_chunk($moreRatedMovies, 4);

        // Base de imagens p/ usar na view
        $imageBase = 'https://image.tmdb.org/t/p/w500';

        return view('pages.movies.home', compact(
            'movies', 
            'moreRatedMoviesChunks', 
            'imageBase', 
            'page'
            )
        );
    }
}
