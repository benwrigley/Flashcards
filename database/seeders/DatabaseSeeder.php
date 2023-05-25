<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Flashcard;
use App\Models\Post;
use App\Models\Test;
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
        Topic::truncate();
        Flashcard::truncate();
        Test::truncate();

        $users = User::factory(2)->create();

        $users->push(
            User::factory()->create([
                'email' => 'ben@jammin.co.uk',
                'password' => 'sh0re8ased'
            ])
        );

        $colours = collect(['bg-blue-300',
        'bg-purple-400',
        'bg-red-400',
        'bg-green-400',
        'bg-yellow-400',
        'bg-gray-600',
        'bg-pink-400']);

        $subjects = collect(['Physics', 'Art and Design','Business','IT','French','Drama','Religion','History','Chemistry','Social Studies','Maths','Music','Geography','English','Biology','Spanish']);
        $topics = collect([]);
        $flashcards = collect([]);
        //create 4 main topics for a user
        foreach($subjects as $subject){
            $topics->push(
                Topic::factory()->create([
                    'user_id' => $users->random()->id,
                    'name' => $subject,
                    'background' => $colours->random()
                ])
            );
        }

        //create topics at all levels
        $counter = 0;
        while ($counter < 40 ){

            $t = $topics->random();

            $topics->push(
                Topic::factory()->create([
                    'user_id' => $t->user_id,
                    'name' => $t->name . ' subtopic',
                    'topic_id' => $t->id,
                    'background' => $colours->random()
                ])
            );

            $counter++;
        }

        $noChildren = Topic::DoesntHave('children')->get();

        $counter = 0;
        while ($counter < 200 ){
            $nc = $noChildren->random();
            $flashcards->push(
                Flashcard::factory()->create([
                    'question' => $nc->name . " " . fake()->paragraph(1),
                    'user_id' => $nc->user_id,
                    'topic_id' => $nc->id
                ])
            );
            $counter++;
        }

        $counter = 0;
        while ($counter < 200 ){
            $nc = $noChildren->random();
            $test = Test::factory()->create([
                    'user_id' => $nc->id,
            ]);

            $test->flashcards()->attach($flashcards->random(15)->pluck('id'));

            $counter++;
        }

    }
}
