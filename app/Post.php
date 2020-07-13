<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Plmrlnsnts\Commentator\HasComments;
use Rennokki\Befriended\Traits\CanBeLiked;
use Rennokki\Befriended\Contracts\Likeable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model implements Likeable
{
    use CanBeLiked, HasComments;

    protected $fillable = ['body', 'user_id'];

    protected $with = ['user', 'comments', 'comments.author', 'comments.replies', 'comments.replies.author'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
