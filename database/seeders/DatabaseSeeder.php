<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Flashcard;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
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

        User::truncate();
        Category::truncate();
        Post::truncate();
        Topic::truncate();
        Flashcard::truncate();

        $users = User::factory(2)->create();

        foreach($users as $user){

            //create 4 main topics for a user
            $topics = Topic::factory(4)->create([
                'user_id' => $user->id
            ]);


            $l2topics = collect([]);
            foreach ($topics as $topic){
                $l2topics = $l2topics->merge(Topic::factory(4)->create([
                    'user_id' => $user->id,
                    'topic_id' => $topic->id
                ]));
            }

            foreach ($l2topics->random(8) as $topic){

                Flashcard::factory(10)->create([
                    'user_id' => $user->id,
                    'topic_id' => $topic->id
                ]);
            }
        }

    }
}
