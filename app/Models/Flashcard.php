<?php

namespace App\Models;

use App\Models\Test;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class Flashcard extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function shorterQuestion($limit){

        return Str::limit($this->question, $limit , '...');

    }

    public function scopeFromTopics($query,$topics)
    {

        return $query->wherein('topic_id', $topics);

    }

    public function scopeWorstPerforming($query,$limit)
    {
        return $query
            ->withCount('tests')
            ->orderBy('avg_score','asc')
            ->limit($limit);
    }

    public function scopeLeastTested($query,$limit)
    {
        return $query
            ->withCount('tests')
            ->orderBy('tests_count','asc')
            ->limit($limit);
    }

    public function scopeRandomSelection($query,$limit)
    {
        return $query
            ->withCount('tests')
            ->inRandomOrder()
            ->limit($limit);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class,'topic_id');
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class)->withTimestamps();
    }
}
