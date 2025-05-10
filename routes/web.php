<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\ProfileController;
use App\Models\Tarea; // Asegúrate de importar el modelo Tarea

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Ruta para la página de inicio (landing page)
Route::get('/', function () {
    return view('welcome'); // Asumimos que tu vista de inicio se llama 'welcome'
})->name('home');

// Ruta para el dashboard (muestra la vista dashboard.blade.php)
Route::get('/dashboard', function () {
    $tareasPropias = auth()->user()->tareasPropias;
    $tareasInvitado = auth()->user()->tareasInvitado;

    return view('dashboard', compact('tareasPropias', 'tareasInvitado'));
})->name('dashboard');

// Rutas para el registro
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Rutas para el inicio de sesión
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', function () {
    // Puedes mostrar un mensaje o redirigir a otra página
    return redirect()->route('tareas.index')->with('info', 'La edición de perfil no está implementada aún.');
})->name('profile.edit');

// Rutas relacionadas con las tareas (protegidas por autenticación)
Route::middleware(['auth'])->group(function () {
    Route::resource('tareas', TareaController::class);
    Route::post('/tareas/{tarea}/invitar', [TareaController::class, 'inviteUser'])->name('tareas.invitar');
    Route::post('/tareas/{tarea}/archivos', [TareaController::class, 'uploadFile'])->name('tareas.archivos.subir');
    Route::delete('/archivos/{archivo}', [TareaController::class, 'deleteFile'])->name('archivos.eliminar');
});

Route::get('/home', function () {
    return view('home');
})->name('home');