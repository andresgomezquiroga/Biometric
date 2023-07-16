<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Horarios;
use Illuminate\Http\Request;


class HorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horarios = Horarios::all();
        return view('home.timeTable.index', compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home.timeTable.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Jornada' => 'required|in:Manana,Tarde,Mixta',
            'Fecha_inicio' => 'required',
            'Fecha_finalizacion' => 'required',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Horarios::create([
            'Jornada' => $request->Jornada,
            'Fecha_inicio' => $request->Fecha_inicio,
            'Fecha_finalizacion' => $request->Fecha_finalizacion,
        ]);

        return redirect()->back()->with('success', 'Horario creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Horarios $horarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horarios $horarios)
    {
        return view('home.timeTable.edit', compact('horarios'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $horario)
    {
        $validator = validator($request->all(), [
            'Jornada' => 'required|in:Manana,Tarde,Mixta',
            'Fecha_inicio' => 'required',
            'Fecha_finalizacion' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $horarios = Horarios::findOrFail($horario); // Obtener la instancia del modelo
    
        $horarios->update([
            'Jornada' => $request->Jornada,
            'Fecha_inicio' => $request->Fecha_inicio,
            'Fecha_finalizacion' => $request->Fecha_finalizacion,
        ]);
    
        return redirect()->back()->with('success', 'Horario actualizado exitosamente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horarios $horarios)
    {
        //
        $horarios->delete();
        return redirect()->back()->with('delete', 'ok');
    }
}
