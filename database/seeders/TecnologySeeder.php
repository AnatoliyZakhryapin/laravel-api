<?php

namespace Database\Seeders;

use App\Models\Tecnology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TecnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tecnologies = ['css', 'scss', 'js', 'vue', 'react', 'astro', 'laravel', 'node', 'angular', 'c++'];

        foreach ($tecnologies as $tecnology_name) {

            $tecnology = new Tecnology();
            $tecnology->name = $tecnology_name;
            $tecnology->slug = Str::slug($tecnology_name);
            $tecnology->save();
        }
    }
}
