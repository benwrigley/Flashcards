<?php

namespace App\Models;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    //protected $fillable = ['title','excerpt','body'];

    protected $with = ['category','author'];

    public function scopeFilter($query, array $filters)
    {

        if ($filters['search'] ?? false){
            $query->where(fn($query) =>
                $query->where('title', 'like' , '%' . request('search') . '%')
                ->orWhere('body', 'like' , '%' . request('search') . '%')
            );

        }

        if ($filters['category'] ?? false){
            $query->whereHas('category', fn($query) =>
                $query->where('slug',$filters['category'])
            );
        }

        if ($filters['author'] ?? false){
            $query->whereHas('author', fn($query) =>
                $query->where('username',$filters['author'])
            );
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
