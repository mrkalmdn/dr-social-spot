<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Plmrlnsnts\Commentator\HasComments;
use Rennokki\Befriended\Traits\CanBeLiked;
use Rennokki\Befriended\Contracts\Likeable;

class Post extends Model implements Likeable
{
    use CanBeLiked, HasComments;

    protected $fillable = ['body', 'user_id'];
}
