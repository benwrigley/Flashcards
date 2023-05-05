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

    public function scopeMyPossibleParents($query, $parentId = null)
    {
        return $query
            ->where(['user_id' => Auth::id()])
            ->doesntHave('children')
            ->orderBy('name')
            ->get()
            ->map(
                function ($item, $key){
                    return ['id' => $item->id, 'name' => $item->name . " : " . $item->description];
                });
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
        return $this->hasMany(Topic::class)->withCount('flashcards');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }

    public function getPossibleParents(String $join = null, Array $exclude = null, Collection $topics = null){

        $collection = collect([]);

        $exclude = $exclude ?: $this->getAllDescendantsIds();

        $topics = $topics  ?: Topic::where(['user_id' => $this->user_id, 'topic_id' => null])
                    ->orderBy('name')
                    ->with('descendants')
                    ->get();

        foreach ($topics as $topic){

            if (in_array($topic->id,$exclude) || $topic->flashcards->count() > 0){
                continue;
            }

            $collection->push([
                'id' => $topic->id,
                'name' => $join . $topic->name,
            ]);

            if ($topic->children){
                $collection = $collection->merge($this->getPossibleParents(' ' . $join . '-', $exclude, $topic->descendants));
            }


        }

        return $collection;

    }



    public function getAllDescendantsIds()
{
    $descendantsIds = [];

    foreach ($this->descendants as $descendant) {
        $descendantsIds[] = $descendant->id;
        $descendantsIds = array_merge($descendantsIds, $descendant->getAllDescendantsIds());
    }

    return $descendantsIds;
}
}
