<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::create([
            'first_name' => 'Usuario test',
            'last_name' => 'Usuario test',
            'email' => 'test@gmail.com',
            'age' => fake()->numberBetween(1, 100),
            'gander' => fake()->randomElement(['M', 'F']),
            'type_document' => fake()->randomElement(['CC', 'TI', 'CE']),
            'document_number' => fake()->numberBetween(10000000, 99999999),
            'status' => 'ACTIVE',
            'photo' => null,
            'password' => bcrypt('123456789'),
        ])->assignRole('administrador');
    }
}
