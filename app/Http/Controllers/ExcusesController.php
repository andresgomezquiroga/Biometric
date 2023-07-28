<?php

namespace App\Http\Controllers;

use App\Models\Excuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExcusesController extends Controller
{
    public function index()
    {
        $excuses = Excuses::all();
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
        ]);

        $maxCode = Excuses::max('id_excuse');
        $code = 'DOC' . str_pad($maxCode + 1, 7, '0', STR_PAD_LEFT);

        $excuse = Excuses::create([
            'archive' => $code,
            'comment' => $request->comment
        ]);

        $file = $request->file('archive');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $file->storeAs('public', $code . '_' . $filename);
            $excuse->archive = $code . '_' . $filename;
            $excuse->save();
        }

        //Excusas

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
        ]);

        $excuse->comment = $request->comment;

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
}