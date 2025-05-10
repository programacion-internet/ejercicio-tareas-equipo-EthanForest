<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_vencimiento',
        'user_id',
    ];

    public function propietario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function invitados(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tarea_usuario');
    }
}