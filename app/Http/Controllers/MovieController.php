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

        // Base de imagens p/ usar na view
        $imageBase = 'https://image.tmdb.org/t/p/w500';

        return view('pages.movies.home', compact('movies', 'imageBase', 'page'));
    }
}
