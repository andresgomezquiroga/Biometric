<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;




class UserController extends Controller
{


    /**
    * Metodos para editar perfil
    **/
    public function profile_edit() {
        return view ('home.user.profile');
    }
    public function profile_update(Request $request) {
        $user = Auth::user(); // Obtiene los datos del usuario logueado

        // Validacion de los datos
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required|numeric|between:15,80',
            'gander' => 'required|in:M,F',
            'type_document' => 'required|in:TI,CC,CE',
            'document_number' => 'required|digits_between:1,20',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->age = $request->age;
        $user->gander = $request->gander;
        $user->type_document = $request->type_document;
        $user->document_number = $request->document_number;
        $user->email = $request->email;
        $user->password = $request->password;

        // Validar la foto
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = $user->id . '.' . $photo->getClientOriginalExtension();
            $destinationPath = 'img/photo';
            $photo->move(public_path($destinationPath), $filename);
            $user->photo = $destinationPath . '/' . $filename;
        }

        // Si los datos son diferentes se actualiza
        if ($user->isDirty()){
            $user->update();
            return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
        }else {
            return redirect()->back()->with('info', 'No se realizó ninguna actualización.');
        }
    }


    public function index() {
        $users = User::all();
        return view('home.user.index' , compact('users'));
    }
    public function create() {
        return view('home.user.create');
    }
    public function store(Request $request) {

       $request->validate([
           'first_name' => 'required',
           'last_name' => 'required',
           'age' => 'required|numeric|between:15,80',
           'gander' => 'required|in:M,F',
           'type_document' => 'required|in:TI,CC,CE',
           'document_number' => 'required|integer',
           'email' => 'required|email|unique:users',
       ]);

       $user = new User();

       $user->first_name = $request->post('first_name');
       $user->last_name = $request->post('last_name');
       $user->age = $request->post('age');
       $user->gander = $request->post('gander');
       $user->type_document = $request->post('type_document');
       $user->document_number = $request->post('document_number');
       $user->email = $request->post('email');
       $user->password = bcrypt($request->post('document_number'));
       $user->status = 'ACTIVE';

       $user->save();

       return redirect()->back()->with('success', 'Usuario creado correctamente.');
    }
    public function show(string $id) {
        $user = User::findOrFail($id);
        return view('home.user.show', compact('user'));
    }
    public function edit(string $id) {
        $user = User::findOrFail($id);
        return view('home.user.edit', compact('user'));
    }

    public function update(Request $request, string $id) {

        $user = User::findOrFail($id);

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
            'status' => 'required|in:ACTIVE,INACTIVE'
        ]);

        $fieldsToUpdate = [
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'gander' => 'gander',
            'type_document' => 'type_document',
            'document_number' => 'document_number',
            'email' => 'email',
            'age' => 'age',
            'status' => 'status'
        ];

        foreach ($fieldsToUpdate as $field => $attribute) {
            if ($attribute != 'password' && $datosActuales[$attribute] != $validatedData[$field]) {
                $user->$attribute = $validatedData[$field];
                $huboCambios = true;
            }
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


    public function destroy(string $id) {
        $user = User::findOrFail($id);
        if ($user->photo) {
            $photoPath = public_path($user->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }
        $user->delete();
        return redirect()->back()->with('delete', 'ok');
    }

}
