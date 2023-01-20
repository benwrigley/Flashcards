<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

        return cache()->remember("average_score." . $this->id, 60000, function(){
            return round(
                (Test::myCompleted()->sum('final_score') / Test::myCompleted()->sum('max_score') * 100),
                    1
            );
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
}
