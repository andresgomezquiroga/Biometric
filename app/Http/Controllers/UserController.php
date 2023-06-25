<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    // Editar perfil
    public function profile_edit() {
        return view ('home.user.profile');
    }
    public function profile_update(Request $request) {
        $user = Auth::user();
        $datosActuales = $user->toArray();
        $huboCambios = false;

        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required|numeric|between:15,80',
            'gander' => 'required|in:M,F',
            'type_document' => 'required|in:TI,CC,CE',
            'document_number' => 'required|integer',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $fieldsToUpdate = [
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'gander' => 'gander',
            'type_document' => 'type_document',
            'document_number' => 'document_number',
            'email' => 'email',
            'age' => 'age',
        ];

        foreach ($fieldsToUpdate as $field => $attribute) {
            if ($attribute != 'password' && $datosActuales[$attribute] != $validatedData[$field]) {
                $user->$attribute = $validatedData[$field];
                $huboCambios = true;
            }
        }

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = $user->id . '.' . $photo->getClientOriginalExtension();
            $destinationPath = 'img/photo';
            $photo->move(public_path($destinationPath), $filename);
            $user->photo = $destinationPath . '/' . $filename;
            $huboCambios = true;
        }

        if ($user->password != $validatedData['password']) {
            $user->password = bcrypt($validatedData['password']);
            $huboCambios = true;
        }

        if ($huboCambios) {
            $user->update();
            return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
        } else {
            return redirect()->back()->with('info', 'No se realizó ninguna actualización.');
        }
    }



    public function index()
    {
        $users = User::all();
        return view('home.user.index' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
