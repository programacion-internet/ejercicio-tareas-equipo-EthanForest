<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Archivo;

class ArchivoPolicy
{
    /**
     * Determine if the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Archivo $archivo)
    {
        // Aquí va tu lógica de autorización. Por ejemplo:
        return $user->id === $archivo->user_id; // Solo el propietario puede eliminar
        // o
        // return $user->hasRole('admin'); // Los administradores pueden eliminar
        // o
        // return $user->can('eliminar-archivos'); // Usuarios con el permiso 'eliminar-archivos'
    }
}