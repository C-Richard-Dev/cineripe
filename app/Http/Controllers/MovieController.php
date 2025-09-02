<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TmdbService;
use App\Models\Rating;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index(Request $request, TmdbService $tmdb)
    {
        $page = (int) $request->integer('page', 1);
        if ($page < 1) $page = 1;
        if ($page > 500) $page = 500; // limite da API

        // Pega os filmes em alta para o carrossel principal
        $trendingData = $tmdb->trendingMovies('day', $page);
        $movies = $trendingData['results'] ?? [];

        // Pega filmes mais bem avaliados para o segundo carrossel
        $moreRatedMovies = array_filter($movies, function ($movie) {
            return isset($movie['vote_average']) && $movie['vote_average'] >= 7;
        });
        // Chunks de Melhores Avaliados
        $moreRatedMoviesChunks = array_chunk($moreRatedMovies, 4);

        // Pega filmes de superherois para o terceiro carrossel
        $superheroData = $tmdb->superHeroMovies($page);
        $superHeroMovies = $superheroData['results'] ?? [];
        $superHeroMoviesChunks = array_chunk($superHeroMovies, 4);

        // Pega filmes de romance para o quarto carrossel
        $romanceData = $tmdb->romanceMovies($page);
        $romanceMovies = $romanceData['results'] ?? [];
        $romanceMoviesChunks = array_chunk($romanceMovies, 4); 

        // Pega filmes de animes para o quinto carrossel
        $animeData = $tmdb->animeMovies($page);
        $animeMovies = $animeData['results'] ?? [];
        $animeMoviesChunks = array_chunk($animeMovies, 4);

        // Pega filmes de comêdia para o sexto carrossel
        $comedyData = $tmdb->comedyMovies($page);
        $comedyMovies = $comedyData['results'] ?? [];
        $comedyMoviesChunks = array_chunk($comedyMovies, 4);

        // -- Lógica para o novo banner carrossel --
        $nowPlayingData = $tmdb->NowPlayingMovies();
        $upcomingData = $tmdb->UpcomingMovies();

        $banners = [];
        // Pega o primeiro filme de cada lista para usar como banner
        if (!empty($movies)) {
            $banners[] = $movies[0];
        }
        if (!empty($nowPlayingData['results'])) {
            $banners[] = $nowPlayingData['results'][0];
        }
        if (!empty($upcomingData['results'])) {
            $banners[] = $upcomingData['results'][0];
        }

        // Base de imagens para os pôsteres
        $imageBase = 'https://image.tmdb.org/t/p/w500';

        // Base de imagens para os banners (maior resolução)
        $bannerBase = 'https://image.tmdb.org/t/p/w1280';

        return view('pages.movies.home', compact(
            'movies',
            'moreRatedMoviesChunks',
            'superHeroMoviesChunks',
            'romanceMoviesChunks',
            'animeMoviesChunks',
            'comedyMoviesChunks',
            'banners', // Passa os banners para a view
            'imageBase',
            'bannerBase', // Passa a base de URL para os banners
            'page'
        ));
    }



    public function details (int $movie){
        // Chave e API base
        $apiKey = config('services.tmdb.key'); // coloca tua chave em config/services.php
        $apiUrl = "https://api.themoviedb.org/3/movie/{$movie}";

        // Request para pegar detalhes
        $res = Http::get($apiUrl, [
            'api_key'  => $apiKey,
            'language' => 'pt-BR', // ou usa $this->lang()
            'append_to_response' => 'videos,credits', //traz trailers e elenco
        ]);

        $ratings = Rating::where('tmdb_id', $movie)->get();

        // if (!$res->successful()) {
        //     dd($res->status(), $res->body());
        // }

        // Se falhar, redireciona
        if (!$res->successful()) {
            abort(404, 'Filme não encontrado');
        }

        $movie = $res->json();

        return view('pages.movies.details', compact('movie', 'ratings'));
    }
}
