<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tecnology;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        // recuperiamo collezione di Type da DB
        $types = Type::all();
        // Creamo un array con solo id di ogni collezione per passare questo dato a randoElement() 
        $typeIds = $types->pluck('id');

         // recuperiamo collezione di Tycnologies da DB
        $tecnologies = Tecnology::all();
        // Creamo un array con solo id di ogni collezione per passare questo dato a randoElements() 
        $tecnologyIds = $tecnologies->pluck('id');

        // recuperiamo collezione di Tycnologies da DB
        $users = User::all();
        // Creamo un array con solo id di ogni collezione per passare questo dato a randoElements() 
        // $userIds = $users->pluck('id');


        for ($i = 0; $i < 50; $i++) {
            $new_project = new Project();

            $new_project->title = $faker->sentence(5);
            $new_project->slug = Str::slug($new_project->title, '-');
            $new_project->description = $faker->text(500);
            $new_project->url = $faker->url();
            $new_project->type_id = $faker->optional()->randomElement($typeIds);
            $new_project->user_id = $users->random()->id;
            $new_project->save();

            // Assegnamo a ogni project le tecnologie con il metodo randomElements
            $new_project->tecnologies()->attach($faker->randomElements($tecnologyIds, null));
        }
    }
}
