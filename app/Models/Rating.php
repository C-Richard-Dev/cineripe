<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    // Força o uso da tabela correta
    protected $table = 'ratings';

    // Campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'user_id',
        'tmdb_id',
        'rating',
        'comment',
    ];

    /**
     * Relacionamento: um rating pertence a um usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
