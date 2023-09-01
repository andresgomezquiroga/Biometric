<?php

namespace App\Http\Controllers;

use App\Models\Excuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Horarios;
use Illuminate\Support\Facades\Auth;

class ExcusesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole('Administrador') || $user->hasRole('Instructor')) {
            $excuses = Excuses::all();
        } elseif ($user->hasRole('Aprendiz')) {
            $excuses = $user->excuses()->get();
        }
    
        
        return view('home.excuse.index', compact('excuses'));
    }

    public function create()
    {
        return view('home.excuse.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'archive' => 'required|file|mimes:pdf,docx,jpg,jpeg,png',
            'date_excuse' => 'required',
        ]);
    
        $maxCode = Excuses::max('id_excuse');
        $code = 'DOC' . str_pad($maxCode + 1, 7, '0', STR_PAD_LEFT);
    
        $user = Auth::user(); // Obtener el usuario autenticado
    
        $excuse = $user->excuses()->create([
            'archive' => $code, // Esto parece incorrecto, ¿debería ser 'archive' => $request->archive?
            'comment' => $request->comment,
            'date_excuse' => $request->date_excuse
        ]);
    
        $file = $request->file('archive');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $file->storeAs('public', $code . '_' . $filename);
            $excuse->archive = $code . '_' . $filename;
            $excuse->save();
        }
    
        return redirect()->back()->with('success', 'Excuse creada exitosamente');
    }

    public function edit(Excuses $excuse)
    {
        return view('home.excuse.edit', compact('excuse'));
    }

    public function update(Request $request, Excuses $excuse)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'archive' => 'nullable|file|mimes:pdf,docx,jpg,jpeg,png',
            'date_excuse' => 'required',
        ]);

        $excuse->comment = $request->comment;
        $excuse->date_excuse = $request->date_excuse;

        $newFile = $request->file('archive');
        if ($newFile) {
            $filename = $newFile->getClientOriginalName();
            Storage::delete('public/' . $excuse->archive);
            $newFile->storeAs('public', $excuse->archive . '_' . $filename);
            $excuse->archive = $excuse->archive . '_' . $filename;
        }

        $excuse->save();

        return redirect()->back()->with('success', 'Excuse actualizada exitosamente');
    }

    public function destroy(Excuses $excuse)
    {
        Storage::delete('public/' . $excuse->archive);
        $excuse->delete();
        return redirect()->back()->with('delete', 'ok');
    }


    public function approveExcuse($id)
    {
        $excuse = Excuses::findOrFail($id);
        $excuse->status = 'aprobada';
        $excuse->save();
    
        return redirect()->back()->with('success', 'Excusa aprobada exitosamente');
    }
    
    public function rejectExcuse($id)
    {
        $excuse = Excuses::findOrFail($id);
        $excuse->status = 'rechazada';
        $excuse->save();
    
        return redirect()->back()->with('success', 'Excusa rechazada exitosamente');
    }
}
