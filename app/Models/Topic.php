<?php

namespace App\Models;

use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Topic extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeMine($query, $parentId = null)
    {
        return $query->where(['user_id' => Auth::id(), 'topic_id' => $parentId ?? null]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function flashcards()
    {
        return $this->hasMany(Flashcard::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function parent()
    {
        return $this->belongsTo(Topic::class,'topic_id');
    }

    public function children()
    {
        return $this->hasMany(Topic::class);
    }


    public function getAncestors()
    {

        return cache()->remember("ancestors." . $this->id, 600, function(){
            return $this->_getAncestors($this , collect([]));
        });


    }

    private function _getAncestors(Topic $topic,Collection $ancestory){

        $ancestory->prepend($topic);

        if($topic->parent()->exists()){
            $this->_getAncestors($topic->parent,$ancestory);
        }

        return $ancestory;

    }

    public function getDescendants()
    {
        return $this->_getDescendants($this, []);

    }


    private function _getDescendants(Topic $topic, Array $topics){

        if ($topic->flashcards()->exists()){
            array_push($topics, $topic->id);
        }

        foreach ($topic->children as $child){
            $topics = $this->_getDescendants($child,$topics);
        }

        return $topics;

    }
}
