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

        return view('home.permission.index', compact('permissions'));
    }

    public function editProfile () {
        return view('home.permission.edit');
    }

    public function create()
    {
        $permissionGroups = $this->getPermissionGroups();
        $groupedPermissions = $this->getGroupedPermissions();
        return view('home.permission.create', compact('permissionGroups', 'groupedPermissions'));
    }
    public function store(Request $request)
    {
        $group = $request->input('group');
        $permissionName = $request->input('permission');

        $permission = $this->getPermissionByNameAndGroup($permissionName, $group);

        if (!$permission) {
            // se crea el permiso si no existe
            $permission = Permission::create(['name' => $permissionName, 'group' => $group]);
        }

        // Agregamos el permiso al grupo
        $selectedPermissions = session()->get('selected_permissions', []);
        $selectedPermissions[] = $permission->toArray();
        session()->put('selected_permissions', $selectedPermissions);

        return redirect()->back()->with('success', 'Permiso creado y asignado exitosamente.');
    }


    protected function getGroupedPermissions()
    {
        return [
            'Fichas' => [
                ['name' => 'ficha.index', 'label' => 'Listar fichas'],
                ['name' => 'ficha.create', 'label' => 'Crear ficha'],
            ],

            'Usuarios' => [
                ['name' => 'user.index', 'label' => 'Listar usuarios'],
                ['name' => 'user.create', 'label' => 'Crear usuario'],
            ],
            'Programas' => [
                ['name' => 'program.index', 'label' => 'Listar programas'],
                ['name' => 'program.create', 'label' => 'Crear programa'],
            ],
            'Roles' => [
                ['name' => 'role.index', 'label' => 'Listar roles'],
                ['name' => 'role.create', 'label' => 'Crear roles'],
            ],
            'Asistencias' => [
                ['name' => 'attendance.index', 'label' => 'Listar asistencias'],
                ['name' => 'attendance.create', 'label' => 'Crear asistencia'],
            ],
            'Excusas' => [
                ['name' => 'excuse.index', 'label' => 'Listar excusas'],
                ['name' => 'excuse.create', 'label' => 'Crear excusa'],
            ],
            'Horarios' => [  // Cambia uno de los 'Horarios' a otro nombre
                ['name' => 'timeTable.index', 'label' => 'Listar horarios'],
                ['name' => 'timeTable.create', 'label' => 'Crear horario'],
            ],
        ];
    }

    protected function getPermissionGroups()
    {
        // Devuelve la lista de grupos de permisos
        return ['Fichas', 'Horarios', 'Usuarios', 'Programas', 'Roles', 'Asistencias', 'Excusas', 'Horarios'];
    }

    protected function getPermissionByNameAndGroup($name, $group)
    {
        // Busca y devuelve el permiso basado en el nombre y el grupo
        return Permission::where('name', $name)->where('group', $group)->first();
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('home.permission.edit', compact('permission'));
    }

    public function update($id)
    {
        $permission = Permission::findOrFail($id);

        // Actualizamos la información del permiso si es necesario

        $permission->save();

        return redirect()->back()->with('success', 'Permiso actualizado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    /*public function show(string $id)
    {
        //
    }*/

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->back()->with('delete', 'ok');
    }

}
