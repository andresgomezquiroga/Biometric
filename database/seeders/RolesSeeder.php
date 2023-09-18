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
        $instruct = Role::create(['name' => 'Instructor']);
        $aprendiz = Role::create(['name' => 'Aprendiz']);

        Permission::create([
            'name' => 'role.index',
            'group' => 'Listar roles'
        ]);/*1*/

        Permission::create([
            'name' => 'role.create',
            'group' => 'Crear roles'
        ]);/*2*/

        Permission::create([
            'name' => 'ficha.index',
            'group' => 'Listar ficha'

        ]);/*3*/
        Permission::create(['name' => 'ficha.create', 'group' => 'Crear ficha']);/*4*/
        Permission::create(['name' => 'program.index', 'group' => 'Listar programa']);/*5*/
        Permission::create(['name' => 'program.create', 'group' => 'Crear programa']);/*6*/
        Permission::create(['name' => 'attendance.index', 'group' => 'Listar asistencias']);/*7*/
        Permission::create(['name' => 'attendance.create', 'group' => 'Crear asistencias']);/*8*/
        Permission::create(['name' => 'excuse.index', 'group' => 'Listar excusas']);/*9*/
        Permission::create(['name' => 'excuse.create', 'group' => 'Crear excusas']);/*10*/
        Permission::create(['name' => 'user.index', 'group' => 'Listar ususarios']);/*11*/
        Permission::create(['name' => 'user.create', 'group' => 'Crear usuarios']);/*12*/
        Permission::create(['name' => 'permission.index', 'group' => 'Listar permission']);/*13*/
        Permission::create(['name' => 'permission.create', 'group' => 'Crear permission']);/*14*/
        Permission::create(['name' => 'timeTable.index', 'group' => 'listar horario']);/*15*/
        Permission::create(['name' => 'timeTable.create', 'group' => 'Crear horario']);/*16*/
        
        $aprendiz->permissions()->attach([
            3,15,9,10
        ]);
        $instruct->permissions()->attach([
            3,5,7,9,15
        ]);

        $admin->permissions()->attach([
            1,2,3,4,5,6,7,8,9,10,11,12,13,14,
            15,16
        ]);
    }
}
