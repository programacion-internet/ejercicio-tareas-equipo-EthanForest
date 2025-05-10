<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Archivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tarea_id',
        'nombre_original',
        'nombre_archivo',
        'ruta_archivo',
        'mime_type',
    ];

    /**
     * Get the user that uploaded the file.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tarea that the file belongs to.
     */
    public function tarea(): BelongsTo
    {
        return $this->belongsTo(Tarea::class);
    }
}