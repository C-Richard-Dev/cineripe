@extends('layouts.app') {{-- se estiver usando Breeze --}}
@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex items-baseline justify-between">
        <h1 class="text-2xl font-semibold">🔥 Em alta hoje</h1>
        <div class="space-x-2">
            @if(($page ?? 1) > 1)
                <a href="{{ route('home', ['page' => $page - 1]) }}" class="underline">← Anterior</a>
            @endif
            <a href="{{ route('home', ['page' => ($page ?? 1) + 1]) }}" class="underline">Próxima →</a>
        </div>
    </div>

    @if(empty($movies))
        <p class="mt-6 text-gray-600">Nada encontrado agora. Tente novamente em instantes.</p>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 mt-6">
            @foreach($movies as $m)
                @php
                    $poster = $m['poster_path'] ? $imageBase . $m['poster_path'] : null;
                    $title  = $m['title'] ?? $m['name'] ?? 'Sem título';
                    $date   = $m['release_date'] ?? null;
                    $rating = $m['vote_average'] ?? null;
                @endphp

                <a href="#" class="group block rounded-2xl overflow-hidden shadow hover:shadow-lg transition">
                    <div class="aspect-[2/3] bg-gray-100">
                        @if($poster)
                            <img
                                src="{{ $poster }}"
                                alt="{{ $title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition"
                                loading="lazy"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                Sem pôster
                            </div>
                        @endif
                    </div>
                    <div class="p-3">
                        <h2 class="text-sm font-semibold leading-tight line-clamp-2">{{ $title }}</h2>
                        <div class="mt-1 text-xs text-gray-500 flex items-center justify-between">
                            <span>{{ $date ? \Illuminate\Support\Str::of($date)->substr(0,4) : '—' }}</span>
                            <span>⭐ {{ $rating ? number_format($rating, 1, ',', '.') : '—' }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
