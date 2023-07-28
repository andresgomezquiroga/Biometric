<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use Illuminate\Http\Request;
use App\Models\Ficha;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $competences = Competence::with('ficha')->get();
        return view('home.competence.index', compact('competences'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $fichas = Ficha::all();
        return view('home.competence.create', compact('fichas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name_competence' => 'required',
            'description_competence' => 'required',
            'ficha_id' => 'required',
        ]);

        $competence = new Competence();
        $competence->name_competence = $request->input('name_competence');
        $competence->description_competence = $request->input('description_competence');
        $competence->ficha_id = $request->input('ficha_id');
        $competence->save();

        return redirect()->back()->with('success', 'Competencia creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Competence $competence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competence $competence)
    {
        //
        $fichas = Ficha::all();
        return view('home.competence.edit', compact('competence', 'fichas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Competence $competence)
    {
        //
        $competence::find($request->input('id_competence'));

        $request->validate([
            'name_competence' => 'required',
            'description_competence' => 'required',
            'ficha_id' => 'required',
        ]);

        $competence->name_competence = $request->input('name_competence');
        $competence->description_competence = $request->input('description_competence');
        $competence->ficha_id = $request->input('ficha_id');
        $competence->update();

        return redirect()->back()->with('success', 'Competencia actualizada exitosamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competence $competence)
    {
        //
        $competence->delete();
        return redirect()->back()->with('delete', 'ok');

    }
}