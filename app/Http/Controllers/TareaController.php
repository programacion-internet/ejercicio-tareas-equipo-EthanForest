<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\User;
use App\Models\Archivo;
use App\Http\Requests\StoreTareaRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\UpdateTareaRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\TareaInvitada as TareaInvitadaMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class TareaController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tareasPropias = auth()->user()->tareasPropias;
        $tareasInvitado = auth()->user()->tareasInvitado;

        return view('tareas.index', compact('tareasPropias', 'tareasInvitado'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tareas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTareaRequest $request)
    {
        $tarea = new Tarea();
        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->fecha_vencimiento = $request->fecha_vencimiento;
        $tarea->user_id = auth()->id(); // Asigna el propietario
        $tarea->save();

        return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        if (! Gate::allows('view', $tarea)) {
            abort(403, 'No estás autorizado para ver esta tarea.');
        }
        $archivos = $tarea->archivos;
        return view('tareas.show', compact('tarea', 'archivos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        if (! Gate::allows('update', $tarea)) {
            abort(403, 'No estás autorizado para editar esta tarea.');
        }
        return view('tareas.edit', compact('tarea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTareaRequest $request, Tarea $tarea)
    {
        if (! Gate::allows('update', $tarea)) {
            abort(403, 'No estás autorizado para editar esta tarea.');
        }

        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->fecha_vencimiento = $request->fecha_vencimiento;
        $tarea->save();

        return redirect()->route('tareas.show', $tarea->id)->with('success', 'Tarea actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        if (! Gate::allows('delete', $tarea)) {
            abort(403, 'No estás autorizado para eliminar esta tarea.');
        }

        $tarea->delete();

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada exitosamente.');
    }

    public function invite(Tarea $tarea)
    {
        if (! Gate::allows('inviteUser', $tarea)) {
            abort(403, 'No estás autorizado para invitar usuarios a esta tarea.');
        }

        $usuarios = User::where('id', '!=', auth()->id())->get(); // Obtener otros usuarios
        return view('tareas.invite', compact('tarea', 'usuarios'));
    }

    public function inviteUser(Request $request, Tarea $tarea)
    {
        if (! Gate::allows('inviteUser', $tarea)) {
            abort(403, 'No estás autorizado para invitar usuarios a esta tarea.');
        }

        $request->validate([
            'usuarios' => 'required|array',
            'usuarios.*' => 'exists:users,id',
        ]);

        foreach ($request->input('usuarios') as $userId) {
            $usuarioInvitado = User::findOrFail($userId);
            $tarea->invitados()->attach($usuarioInvitado);

            // Disparar evento para enviar correo (Historia de Usuario 3)
            Mail::to($usuarioInvitado->email)->send(new TareaInvitadaMail($tarea, auth()->user()));
        }

        return redirect()->route('tareas.show', $tarea->id)->with('success', 'Usuarios invitados a la tarea.');
    }

    public function uploadFile(Request $request, Tarea $tarea)
    {
        if (! Gate::allows('view', $tarea)) { // Los invitados también pueden subir archivos
            abort(403, 'No estás autorizado para subir archivos a esta tarea.');
        }

        $request->validate([
            'archivo' => 'required|file|max:2048', // Máximo 2MB
        ]);

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombreOriginal = $archivo->getClientOriginalName();
            $nombreArchivo = uniqid() . '_' . $nombreOriginal;
            $rutaArchivo = $archivo->storeAs('tareas/' . $tarea->id, $nombreArchivo, 'public');

            Archivo::create([
                'user_id' => auth()->id(),
                'tarea_id' => $tarea->id,
                'nombre_original' => $nombreOriginal,
                'nombre_archivo' => $nombreArchivo,
                'ruta_archivo' => $rutaArchivo,
                'mime_type' => $archivo->getClientMimeType(),
            ]);

            return back()->with('success', 'Archivo subido exitosamente.');
        }

        return back()->with('error', 'Error al subir el archivo.');
    }

    public function deleteFile(Archivo $archivo)
    {
        $this->authorize('delete', $archivo);

        Storage::disk('public')->delete($archivo->ruta_archivo);
        $archivo->delete();

        return back()->with('success', 'Archivo eliminado exitosamente.');
    }
}