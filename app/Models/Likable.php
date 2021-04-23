<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

trait Likable
{
    public function scopeWithLikes(\Illuminate\Database\Eloquent\Builder $query){
        $query->leftJoinSub(
            "select likee_id, sum(liked) likes, sum(!liked) dislikes from likes group by likee_id",
            "likes",
            "likes.likee_id",
            "users.id"
        );
    }

    public function like($user=null){
        $this->likes()->updateOrCreate(
            [
                "likee_id" => $user ? $user->id : auth()->id(),
            ],
            [
                "liked" => true
            ]
        );
    }

    public function dislike($user=null){
        $this->likes()->updateOrCreate(
            [
                "likee_id" => $user ? $user->id : auth()->id(),
            ],
            [
                "liked" => false
            ]
        );
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
}
