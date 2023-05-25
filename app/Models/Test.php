<?php

namespace App\Models;

use App\Models\Flashcard;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Test extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeMyCompleted($query){

        return $query->where(['user_id' => Auth::id()])->whereNotNull('completed_at');

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function getResult(){

        return $this->final_score ?
            round(($this->final_score / ($this->max_score) *100) , 1) :
            0;
    }

    public function getLastFlashcard(){
        return $this->flashcards->last();
    }

    public function getNextFlashcardPosition(){

        $flashcards = $this->flashcards()->get();
        $count =0;
        foreach ($flashcards as $flashcard) {

            if ($flashcard->pivot->created_at->getTimestamp() === $flashcard->pivot->updated_at->getTimestamp()) {
                return $count;
            }
            $count++;
        }

        return null;
    }

    public function flashcards()
    {
        return $this->belongsToMany(Flashcard::class)->withTimestamps();
    }

}
