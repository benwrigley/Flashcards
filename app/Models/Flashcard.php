<?php

namespace App\Models;

use App\Models\Test;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Flashcard extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFromTopics($query,$topics)
    {

        return $query->wherein('topic_id', $topics);

    }

    public function topic()
    {
        return $this->belongsTo(Topic::class,'topic_id');
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class);
    }
}
