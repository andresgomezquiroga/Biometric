<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Models\Programa;
use Illuminate\Http\Request;

class FichaController extends Controller
{
    public function index()
    {
        // Obtiene todas las fichas con sus respectivos programas de formación ......
        $fichas = Ficha::with('programa')->get();

        return view('home.ficha.index', compact('fichas'));
    }

    public function create()
    {
        $programas = Programa::all(); // Esto obtiene todos los programas de formación disponibles

        return view('home.ficha.create', compact('programas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'number_ficha' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'programa_id' => 'required',
        ]);

        $ficha = new Ficha();
        $ficha->number_ficha = $request->input('number_ficha');
        $ficha->date_start = $request->input('date_start');
        $ficha->date_end = $request->input('date_end');
        $ficha->programa_id = $request->input('programa_id');
        $ficha->save();

        return redirect()->route('ficha.index')->with('success', 'Ficha creada exitosamente');
    }

    public function edit(Ficha $ficha)
    {
        $programas = Programa::all();
        return view('home.ficha.edit', compact('ficha', 'programas'));
    }


    public function update(Request $request)
    {
        $ficha = Ficha::find($request->input('id_ficha'));

        if (!$ficha) {
            return redirect()->route('ficha.index')->with('error', 'Ficha no encontrada');
        }

        $request->validate([
            'number_ficha' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'programa_id' => 'required',
        ]);

        $ficha->number_ficha = $request->input('number_ficha');
        $ficha->date_start = $request->input('date_start');
        $ficha->date_end = $request->input('date_end');
        $ficha->programa_id = $request->input('programa_id');
        $ficha->update();

        return redirect()->back()->with('success', 'Ficha actualizada exitosamente');
    }

    public function destroy(Ficha $ficha)
    {
        $ficha->delete();

        return redirect()->route('ficha.index')->with('success', 'Ficha eliminada exitosamente.');
    }
}
