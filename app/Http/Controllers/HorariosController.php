<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Horarios;
use Illuminate\Http\Request;
use App\Models\Ficha;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;




class HorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $horarios = [];
    
        if ($user->hasRole('Administrador')) {
            // Si es un administrador, obtén todos los horarios
            $horarios = Horarios::with(['ficha.instructors'])->get();
        } elseif ($user->hasRole('Instructor')) {
            // Si es un instructor, obtén las fichas relacionadas con el instructor
            $fichas = $user->fichas;
    
            // Obtén los horarios relacionados con esas fichas
            $horarios = Horarios::whereIn('ficha_id', $fichas->pluck('id_ficha'))->with(['ficha.instructors'])->get();
        }
    
        return view('home.timeTable.index', compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fichas = Ficha::with('instructors')->get();
        return view('home.timeTable.create', compact('fichas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Jornada' => 'required|in:Manana,Tarde,Mixta',
            'Fecha_inicio' => 'required',
            'Fecha_finalizacion' => 'required',
            'time_start' => 'required',
            'time_finish' => 'required',
            'ficha_id' => 'required',
        ]);

        $horario = new Horarios();
        $horario->Jornada = $request->input('Jornada');
        $horario->Fecha_inicio = $request->input('Fecha_inicio');
        $horario->Fecha_finalizacion = $request->input('Fecha_finalizacion');
        $horario->time_start = $request->input('time_start');
        $horario->time_finish = $request->input('time_finish');
        $horario->ficha_id = $request->input('ficha_id'); // Asigna la ficha seleccionada
        $horario->save();

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
        $fichas = Ficha::with('instructors')->get();
        return view('home.timeTable.edit', compact('horarios', 'fichas'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $horario)
    {
        $request->validate([
            'Jornada' => 'required|in:Manana,Tarde,Mixta',
            'Fecha_inicio' => 'required',
            'Fecha_finalizacion' => 'required',
            'time_start' => 'required',
            'time_finish' => 'required',
            'ficha_id' => 'required',
        ]);

        $horario = new Horarios();
        $horario->Jornada = $request->input('Jornada');
        $horario->Fecha_inicio = $request->input('Fecha_inicio');
        $horario->Fecha_finalizacion = $request->input('Fecha_finalizacion');
        $horario->time_start = $request->input('time_start');
        $horario->time_finish = $request->input('time_finish');
        $horario->ficha_id = $request->input('ficha_id');
        $horario->update();

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
