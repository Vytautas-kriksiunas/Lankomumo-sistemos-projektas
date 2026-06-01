<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            ['name' => 'Kompiuterių tinklai',        'description' => 'TCP/IP, OSI modelis, tinklų administravimas.',      'semester' => 3, 'lecturer_id' => 1],
            ['name' => 'Duomenų bazės',               'description' => 'Reliacinės DB, SQL, normalizacija.',                'semester' => 2, 'lecturer_id' => 2],
            ['name' => 'Programų inžinerija',         'description' => 'Programinės įrangos kūrimo metodologijos.',        'semester' => 4, 'lecturer_id' => 3],
            ['name' => 'Operacinės sistemos',         'description' => 'Linux, Windows administravimas, procesai.',        'semester' => 3, 'lecturer_id' => 1],
            ['name' => 'Objektinis programavimas',    'description' => 'OOP principai, PHP, Java.',                        'semester' => 2, 'lecturer_id' => 4],
            ['name' => 'Interneto technologijos',     'description' => 'HTML, CSS, JavaScript, Laravel.',                  'semester' => 4, 'lecturer_id' => 5],
            ['name' => 'Algoritmų teorija',           'description' => 'Duomenų struktūros, algoritmai, sudėtingumas.',    'semester' => 1, 'lecturer_id' => 2],
            ['name' => 'Informacinė sauga',           'description' => 'Kriptografija, tinklų sauga, atakos.',             'semester' => 5, 'lecturer_id' => 3],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
