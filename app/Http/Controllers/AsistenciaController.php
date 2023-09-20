<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Validator;


class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $asistencias = Asistencia::all();
        return view('home.attendance.index', compact('asistencias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('home.attendance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'admission_time' => 'required|date_format:H:i',
            'name_attendance' => 'required|max:255',
            'code_attendance' => 'required|max:255',
            'apprentices_assisted' => 'required|max:255',
            'exit_time' => 'required|date_format:H:i',
            ]);


        Asistencia::create([
            'admission_time' => $request->admission_time,
            'name_attendance' => $request->name_attendance,
            'code_attendance' => $request->code_attendance,
            'apprentices_assisted' => $request->apprentices_assisted,
            'exit_time' => $request->exit_time
        ]);

        return redirect()->back()->with('success', 'Asistencia creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asistencia $asistencia)
    {
        //
        return view('home.attendance.edit', compact('asistencia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        //
        $request->validate([
            'admission_time' => 'required|date_format:H:i',
            'name_attendance' => 'required|max:255',
            'code_attendance' => 'required|max:255',
            'apprentices_assisted' => 'required|max:255',
            'exit_time' => 'required|date_format:H:i',
            ]);

        $asistencia->update([
            'admission_time' => $request->admission_time,
            'name_attendance' => $request->name_attendance,
            'code_attendance' => $request->code_attendance,
            'apprentices_assisted' => $request->aprentices_assisted,
            'exit_time' => $request->exit_time
        ]);
        return redirect()->back()->with('success', 'Asistencia actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->delete();

        return redirect()->back()->with('delete', 'ok');
    }
}
