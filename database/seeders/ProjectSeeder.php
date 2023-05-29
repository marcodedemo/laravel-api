<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $projects = config('projects');

        foreach($projects as $project){

            $newProject = new Project();

            $newProject->title = $project['title'];
            $newProject->description = $project['description'];
            $newProject->link = $project['link'];
            $newProject->execution_date = $project['execution_date'];
            $newProject->slug = Str::slug($newProject->title, '-');

            $newProject->save();
        }
    }
}
