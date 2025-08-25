<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TmdbService

/**
 * Serviço para interagir com a API do TMDB (The Movie Database)
 * 
 * 
 */

// Todas as colunas de cada filme retornado pela API do TMDB
// {
//     "adult": false,                (se o filme é para maiores de idade),
//     "backdrop_path": "/path/to/backdrop.jpg",            (caminho da imagem de fundo),
//     "genre_ids": [28, 12, 878], (IDs dos gêneros do filme),
//     "id": 123456, (ID do filme),
//     "original_language": "en",           (idioma original do filme),
//     "original_title": "Movie Original Title", (título original do filme),
//     "overview": "Descrição do filme...",
//     "popularity": 1234.567,
//     "poster_path": "/path/to/poster.jpg",
//     "release_date": "2025-02-10",
//     "title": "Título Localizado",
//     "video": false,
//     "vote_average": 8.5,
//     "vote_count": 4500
//     }


{
    private string $api = 'https://api.themoviedb.org/3';
    private string $img = 'https://image.tmdb.org/t/p';

    private function get(string $endpoint, array $params = []): array
    {
        // Adiciona a chave e o idioma padrão aos parâmetros
        $queryParams = array_merge($params, [
            'api_key' => $this->key(),
            'language' => $this->lang(),
        ]);

        $response = Http::get("{$this->api}/{$endpoint}", $queryParams);

        if ($response->successful()) {
            return $response->json();
        }

        // Em caso de falha, retorne um array vazio
        return ['results' => []];
    }

    // Chave da API do TMDB
    private function key(): string
    {
        return (string) config('services.tmdb.key', env('TMDB_API_KEY'));
    }

    // Idioma padrão para as requisições
    private function lang(): string
    {
        return (string) env('TMDB_LANG', 'pt-BR');
    }

    

    /** Trending (home) — day|week */
    // Pega filmes em alta (trending) com cache de 60 minutos
    public function trendingMovies(string $window = 'day', int $page = 1): array
    {
        $cacheKey = "tmdb.trending.$window.page.$page.{$this->lang()}";

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($window, $page) {
            $res = Http::get("{$this->api}/trending/movie/{$window}", [
                'api_key'        => $this->key(),
                'language'       => $this->lang(),
                'include_adult'  => true,
                'page'           => $page,
            ]);

            return $res->successful() ? $res->json() : ['results' => []];
        });
    }


    /**
     * Pega filmes de super-heróis
     */
    public function superheroMovies(string $window = 'day', int $page = 1): array
    {
        $cacheKey = "tmdb.superhero.page.$page.{$this->lang()}";

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($page) {
            $res = Http::get("{$this->api}/discover/movie", [
                'page'          => $page,
                'language'      => $this->lang(),
                'api_key'       => $this->key(),
                'with_keywords' => 9715, // super-herói
                'sort_by'       => 'popularity.desc',
                'include_adult' => false,
            ]);

            return $res->successful() ? $res->json() : ['results' => []];
        });
    }



    /** Imagem do poster/backdrop */
    public function imageUrl(?string $path, string $size = 'w500'): ?string
    {
        if (!$path) return null;
        return "{$this->img}/{$size}{$path}";
    }




    // Filmes em exibição (Now Playing)
    public function nowPlayingMovies($page = 1)
    {
        return $this->get('movie/now_playing', ['page' => $page]);
    }




    // Filmes futuros (Upcoming)
    public function upcomingMovies($page = 1)
    {
        return $this->get('movie/upcoming', ['page' => $page]);
    }


    

    // Todos os filmes populares (Popular)
    public function allMovies($page = 1)
    {
        return $this->get('movie/popular', ['page' => $page]);
    }
}
