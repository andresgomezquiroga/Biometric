<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = Role::create(['name' => 'Administrador']);

        Permission::create([
            'name' => 'role.index',
            'group' => 'Listar role'
        ]);

        Permission::create([
            'name' => 'role.create',
            'group' => 'Crear role'
        ]);

        Permission::create([
            'name' => 'ficha.index',
            'group' => 'Listar ficha'
        ]);
        Permission::create(['name' => 'ficha.create', 'group' => 'Crear ficha']);
        Permission::create(['name' => 'program.index', 'group' => 'Listar programa']);
        Permission::create(['name' => 'program.create', 'group' => 'Crear programa']);
        Permission::create(['name' => 'attendance.index', 'group' => 'Listar attendance']);
        Permission::create(['name' => 'attendance.create', 'group' => 'Crear attendance']);
        Permission::create(['name' => 'excuse.index', 'group' => 'Listar excuse']);
        Permission::create(['name' => 'excuse.create', 'group' => 'Crear excuse']);
        Permission::create(['name' => 'user.index', 'group' => 'Listar user']);
        Permission::create(['name' => 'user.create', 'group' => 'Crear user']);
        Permission::create(['name' => 'competence.index', 'group' => 'Listar competence']);
        Permission::create(['name' => 'competence.create', 'group' => 'Crear competence']);
        Permission::create(['name' => 'permission.index', 'group' => 'Listar permission']);
        Permission::create(['name' => 'permission.create', 'group' => 'Crear permission']);
        
        $admin->permissions()->attach(Permission::all());
        
        
    }
}
