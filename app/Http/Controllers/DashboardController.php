<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tareasPropias = auth()->user()->tareasPropias;
        $tareasInvitado = auth()->user()->tareasInvitado;

        return view('dashboard', compact('tareasPropias', 'tareasInvitado'));
    }
    //
}