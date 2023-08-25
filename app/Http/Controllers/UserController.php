<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;






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

    public function index()
    {
        $users = User::all();
        $userRoles = [];

        foreach ($users as $user) {
            $roles = $user->roles ? $user->roles->pluck('name') : collect(); // Verifica si $user->roles es null y, en ese caso, crea una colección vacía
            $userRoles[$user->id] = $roles->implode(', '); // Agrega los roles a un array asociativo con el id del usuario como índice
        }

        return view('home.user.index', compact('users'))->with('userRoles', $userRoles);
    }
    public function create() {
        $roles = Role::all();
        return view('home.user.create' , compact('roles'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required|numeric|between:15,80',
            'gander' => 'required|in:M,F',
            'type_document' => 'required|in:TI,CC,CE',
            'document_number' => 'required|digits_between:1,20',
            'email' => 'required|email|unique:users',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = new User();

        $user->first_name = $request->post('first_name');
        $user->last_name = $request->post('last_name');
        $user->age = $request->post('age');
        $user->gander = $request->post('gander');
        $user->type_document = $request->post('type_document');
        $user->document_number = $request->post('document_number');
        $user->email = $request->post('email');
        $user->password = Hash::make($request->post('document_number')); // Usar Hash::make para generar el hash de la contraseña
        $user->status = 'ACTIVE';

        $user->save();

        $user->assignRole($request->input('roles')); // Usar assignRole para asignar roles al usuario

        return redirect()->back()->with('success', 'Usuario creado correctamente.');
    }
    public function show(string $id) {
        $user = User::findOrFail($id);
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('home.user.show', compact('user'));
    }
    public function edit(string $id) {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('home.user.edit', compact('user', 'roles', 'userRoles'));
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
            'document_number' => 'required|digits_between:1,20',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:6',
            'status' => 'required|in:ACTIVE,INACTIVE',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
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

        $rolesActuales = $user->roles->pluck('id')->toArray();
        $rolesSeleccionados = $request->input('roles');

        if (count(array_diff($rolesActuales, $rolesSeleccionados)) > 0 || count(array_diff($rolesSeleccionados, $rolesActuales)) > 0) {
            $user->roles()->sync($rolesSeleccionados);
            $huboCambios = true;
        }

        if ($huboCambios) {
            $user->update();
            $user->roles()->sync($request->input('roles'));
            return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
        } else {
            return redirect()->back()->with('info', 'No se realizó ninguna actualización.');
        }

    }

    public function destroy(string $id) {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Detach all roles associated with the user
        $user->roles()->detach();

        // Check if the user has a photo
        if ($user->photo)  {
            // Get the path to the user's photo
            $photoPath = public_path($user->photo);

            // Check if the photo file exists
            if (file_exists($photoPath)) {
                // Delete the photo file
                unlink($photoPath);
            }
        }

        // Delete the user
        $user->delete();

        // Redirect back with success message
        return redirect()->back()->with('destroy_user', 'ok_user');
    }

}
