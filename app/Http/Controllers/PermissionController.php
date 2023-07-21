<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('home.permission.index' , compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('home.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $permission = new Permission();

        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        $permission->name = $request->name;
        $permission->save();

        return redirect()->back()->with('success', 'Permiso creado exitosamente.');
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
        $permission = Permission::findOrFail($id);
        return view('home.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'unique:permissions,name,' . $permission->id,
            ],
        ]);

        $permission->name = $request->name;

        // Check if the permissions have been changed
        if ($permission->isDirty('name')) {
            $permission->save();
            return redirect()->back()->with('success', 'Permiso actualizado exitosamente.');
        } else {
            return redirect()->back()->with('info', 'No se han realizado cambios.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->back()->with('delete', 'ok');
    }
}
