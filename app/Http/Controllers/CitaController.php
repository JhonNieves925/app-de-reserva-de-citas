<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;


class CitaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dependencia' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
        ]);

        Cita::create($request->all());

        

       // return redirect()->route('citas.index')->with('success', 'Cita agendada correctamente.');
       return redirect('/')->with('success', 'Cita agendada correctamente.');

    }
    
    public function index()
{
    $citas = Cita::orderBy('fecha', 'asc')->get();

    return view('citas.index', compact('citas'));
}



}