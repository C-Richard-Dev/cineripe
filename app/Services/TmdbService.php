<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TmdbService
{
    private string $api = 'https://api.themoviedb.org/3';
    private string $img = 'https://image.tmdb.org/t/p';

    private function key(): string
    {
        return (string) config('services.tmdb.key', env('TMDB_API_KEY'));
    }

    private function lang(): string
    {
        return (string) env('TMDB_LANG', 'pt-BR');
    }

    /** Trending (home) — day|week */
    public function trendingMovies(string $window = 'day', int $page = 1): array
    {
        $cacheKey = "tmdb.trending.$window.page.$page.{$this->lang()}";

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($window, $page) {
            $res = Http::get("{$this->api}/trending/movie/{$window}", [
                'api_key'        => $this->key(),
                'language'       => $this->lang(),
                'include_adult'  => false,
                'page'           => $page,
                'tmdb' => [
                    'key' => env('TMDB_API_KEY'),
                ],
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
}
