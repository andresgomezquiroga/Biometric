<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view ('home.role.index' , compact ('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view ('home.role.create' , compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validar los datos del formulario
         $validatedData = $request->validate([
            'role' => 'required|unique:roles,name',
            'permissions' => 'required|array|min:1',
        ]);

        // Crear el rol
        $role = Role::create([
            'name' => $validatedData['role'],
            'guard_name' => 'web', // Reemplaza 'web' con el valor correcto para tu guardia
        ]);

        // Asignar los permisos al rol
        $permissions = Permission::whereIn('id', $validatedData['permissions'])->get();

        DB::transaction(function () use ($role, $permissions) {
            $role->syncPermissions($permissions);
        });

        return redirect()->back()->with('success', 'Rol creado correctamente.');

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
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        
        return view('home.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        // Validar los datos del formulario
        $validatedData = $request->validate([
            'role' => [
                'required',
                'unique:roles,name,' . $role->id,
            ],
            'permissions' => 'required|array|min:1',
        ]);

        // Actualizar el rol
        $role->name = $validatedData['role'];

        // Validar si los permisos y roles son diferentes
        if ($role->isDirty('permissions') || $role->isDirty('roles') || $validatedData['permissions'] != $role->permissions->pluck('id')->toArray()) {
            $role->save();

            // Asignar los permisos al rol
            $permissions = Permission::whereIn('id', $validatedData['permissions'])->get();

            DB::transaction(function () use ($role, $permissions) {
                $role->syncPermissions($permissions);
            });

            return redirect()->back()->with('success', 'Rol actualizado correctamente.');
        } else {
            return redirect()->back()->with('info', 'No se han realizado cambios.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Encontrar el rol por su ID
         $role = Role::findOrFail($id);

         DB::transaction(function () use ($role) {
             // Eliminar los permisos asociados al rol
             $role->permissions()->detach();
 
             // Eliminar el rol
             $role->delete();
         });
 
         return redirect()->back()->with('delete', 'ok');
    }
}
