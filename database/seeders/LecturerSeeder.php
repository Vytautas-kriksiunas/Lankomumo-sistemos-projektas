<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    public function run(): void
    {
        $lecturers = [
            ['name' => 'Remigijus',  'surname' => 'Laurutis',    'email' => 'r.laurutis@ku.lt',    'birthdate' => '1975-03-15'],
            ['name' => 'Jonas',      'surname' => 'Petraitis',   'email' => 'j.petraitis@ku.lt',   'birthdate' => '1980-06-22'],
            ['name' => 'Rūta',       'surname' => 'Kazlauskienė','email' => 'r.kazlauskiene@ku.lt', 'birthdate' => '1983-11-08'],
            ['name' => 'Tomas',      'surname' => 'Jankauskas',  'email' => 't.jankauskas@ku.lt',  'birthdate' => '1978-01-30'],
            ['name' => 'Aistė',      'surname' => 'Mockūnaitė',  'email' => 'a.mockunaite@ku.lt',  'birthdate' => '1990-07-14'],
        ];

        foreach ($lecturers as $lecturer) {
            Lecturer::create($lecturer);
        }
    }
}
