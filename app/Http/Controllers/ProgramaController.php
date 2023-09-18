<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;


class ProgramaController extends Controller
{
    public function index()
    {
        $programas = Programa::all();

        return view('home.programa.index', compact('programas'));
    }

    public function create()
    {
        return view('home.programa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_program' => 'required',
            'program_code' => 'required',
        ]);
    
    
        Programa::create([
            'name_program' => $request->name_program,
            'program_code' => $request->program_code,
        ]);
    
        return redirect()->back()->with('success', 'Programa creado exitosamente');  
    }

    public function edit(Programa $programa)
    {
        return view('home.programa.edit', compact('programa'));
    }

    public function update(Request $request, Programa $programa)
    {
        $update_program = validator($request->all(), [
            'name_program' => 'required',
            'program_code' => 'required',
        ]);
    
        if ($update_program->fails()) {
            return redirect()->back()->with('info', 'Campos incompletos');
        }
    
        $programa->update([
            'name_program' => $request->name_program,
            'program_code' => $request->program_code,
        ]);
    
        return redirect()->back()->with('success', 'Programa actualizado exitosamente');
    }

    public function destroy(Programa $programa)
    {
        $programa->delete();

        return redirect()->back()->with('delete', 'ok');
    }
}
