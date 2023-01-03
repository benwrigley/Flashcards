<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Topic extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeMine($query)
    {
        return $query->where(['user_id' => Auth::id(), 'topic_id' => null]);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function flashcards()
    {
        return $this->hasMany(Flashcard::class);
    }

    public function parent()
    {
        return $this->belongsTo(Topic::class,'topic_id');
    }

    public function children()
    {
        return $this->hasMany(Topic::class);
    }
}
