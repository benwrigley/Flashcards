<?php

namespace App\Models;

use App\Models\Flashcard;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function getResult(){

        //$result = array();

        return round(($this->final_score / ($this->max_score) *100) , 1);
        // $message = "";
        // switch (true){
        //     case $score < 10:
        //         $message = "Next time will be better!";
        //         break;

        //     case $score < 20:
        //         $message = "Ok, today wasn't your best, but hang in there!";
        //         break;

        //     case $score < 30:
        //         $message = "Better luck next time!";
        //         break;

        //     case $score < 40:
        //         $message =

        // }


    }

    public function flashcards()
    {
        return $this->belongsToMany(Flashcard::class);
    }
}
