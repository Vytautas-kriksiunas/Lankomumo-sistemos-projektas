<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
public function run(): void
{
// Admin
    User::factory()->create([
        'name'     => 'Admin',
        'email'    => 'admin@ku.lt',
        'password' => Hash::make('password'),
        'type'     => 'admin',
    ]);

// Super Admin
    User::factory()->create([
        'name'     => 'Super Admin',
        'email'    => 'superadmin@ku.lt',
        'password' => Hash::make('password'),
        'type'     => 'superAdmin',
    ]);

// Paprastas vartotojas
    User::factory()->create([
        'name'     => 'Test User',
        'email'    => 'test@ku.lt',
        'password' => Hash::make('password'),
        'type'     => 'user',
    ]);
// Papildomi studentai
    $students = [
        ['name' => 'Vytautas Jonaitis',   'email' => 'vytautas@ku.lt'],
        ['name' => 'Marta Kazlauskaitė',  'email' => 'marta@ku.lt'],
        ['name' => 'Lukas Petrauskas',    'email' => 'lukas@ku.lt'],
        ['name' => 'Eglė Stankevičiūtė', 'email' => 'egle@ku.lt'],
        ['name' => 'Mantas Grigas',       'email' => 'mantas@ku.lt'],
    ];

    foreach ($students as $student) {
        User::factory()->create([
            'name'     => $student['name'],
            'email'    => $student['email'],
            'password' => Hash::make('password'),
            'type'     => 'user',
        ]);
    }

$this->call([
LecturerSeeder::class,
SubjectSeeder::class,
]);
}
}
