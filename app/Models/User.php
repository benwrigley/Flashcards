<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function averageScore()
    {

        if ($this->testsCompleted() < 1){
            return 0;
        }

        return cache()->rememberForever("average_score." . $this->id, function(){
            return round(
                (Test::myCompleted()->sum('final_score') / Test::myCompleted()->sum('max_score') * 100),
                    1
            );
        });

    }

    public function leastTestedTopic(){

        if (Topic::mine()->count() < 1){
            return null;
        }

        return cache()->rememberForever("least_tested." . $this->id, function(){
            $topic = DB::table('topics')->selectRaw('count(tests.topic_id) as topic_count, topics.id')
                ->leftJoin('tests', 'topics.id', 'tests.topic_id')
                ->where ('topics.user_id' , $this->id)
                ->groupBy('topics.id')
                ->orderBy('topic_count')
                ->first();

            return Topic::find($topic->id);
        });

    }

    public function testsCompleted()
    {
        return cache()->rememberForever("test_completed." . $this->id, function(){
            return Test::myCompleted()->count();
        });
    }

    public function mostRecentTest()
    {
        return $this->tests->sortByDesc('completed_at')->first();
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function flashcards()
    {
        return $this->hasMany(Flashcard::class);
    }
}
