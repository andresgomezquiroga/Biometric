<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Models\Programa;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Competence;



class FichaController extends Controller
{

    public function index()
    {
        $user = auth()->user();
    
        // Si el usuario es instructor o administrador, obtiene todas las fichas con sus programas de formación
        if ($user->hasRole('Administrador')) {
            $fichas = Ficha::with(['programa'])->get();
        }
        // Si el usuario es aprendiz, obtiene solamente las fichas relacionadas con el permiso específico
        else if ($user->hasRole(['Instructor', 'Aprendiz'])) {
            $fichas = Ficha::whereHas('members', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with(['programa'])->get();
        }

        // Si el usuario no tiene ningún rol reconocido, no se mostrará ninguna ficha
        else {
            $fichas = collect();
        }
    
        return view('home.ficha.index', compact('fichas'));
    }
    public function add_members(Request $request)
    {
        $validatedData = $request->validate([
            'documento' => 'required|numeric',
            'ficha_id' => 'required|exists:fichas,id_ficha',
        ]);

        $user = User::where('document_number', $validatedData['documento'])->first();

        if (!$user) {
            return redirect()->back()->with('error', 'ok');
        }

        $ficha = Ficha::findOrFail($validatedData['ficha_id']);

        // Asociar al usuario a la ficha
        $ficha->members()->attach($user->id);

        return redirect()->back()->with('success', 'ok');
    }

    public function index_members(Request $request, $fichaId)
    {
        $ficha = Ficha::findOrFail($fichaId);
    
        // Cargar la relación members.user.roles
        $ficha->load('members.roles');
    
        return view('home.ficha.index_members', compact('ficha'));
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

        return redirect()->route('ficha.index')->with('delete', 'ok');
    }

}
