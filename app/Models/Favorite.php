<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    // Força o uso da tabela correta
    protected $table = 'favorites';

    protected $fillable = [
        'user_id',
        'tmdb_id',
    ];

    /**
     * Relacionamento: um favorito pertence a um usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
