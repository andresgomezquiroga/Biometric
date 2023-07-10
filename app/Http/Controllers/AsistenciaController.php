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
        $validator = validator($request->all(), [
            'admission_time' => 'required|date_format:H:i',
            'comments' => 'required|max:255',
            ]);

        if ($validator->fails()) {
            return redirect()->back()->with('info', 'Campos incompletos');
        }

        Asistencia::create([
            'admission_time' => $request->admission_time,
            'comments' => $request->comments,
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
        $validator = validator($request->all(), [
            'admission_time' => 'required|date_format:H:i',
            'comments' => 'required|max:255',
            ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with('info', 'Campos incompletos');
        }
        $asistencia->update([
            'admission_time' => $request->admission_time,
            'comments' => $request->comments,
        ]);
        return redirect()->back()->with('success', 'Asistencia actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asistencia $asistencia)
    {
        $asistencia->delete();
        return redirect()->back()->with('delete', 'ok');
    }
}
