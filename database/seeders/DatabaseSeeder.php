<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        User::factory(10)->has(Post::factory(5))->create();
        for ($i=1; $i < Post::count() ; $i++) { 
            for ($j=1; $j < rand(1, 10); $j++) { 
                Post::find($i)->comments()->create([
                    'body' => $faker->realText(10),
                    'user_id' => rand(1,10)

                ]) ;

                Post::find($i)->comments()->create([
                    'body' => $faker->realText(10),
                    'user_id' => rand(1,10)

                ]) ;
                Post::find($i)->comments()->create([
                    'body' => $faker->realText(10),
                    'user_id' => rand(1,10)

                ]) ;
            }         
        }
    }
}
