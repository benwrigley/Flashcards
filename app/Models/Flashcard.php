<?php

namespace App\Models;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function topic()
    {
        return $this->belongsTo(Topic::class,'topic_id');
    }
}
