<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Rennokki\Befriended\Contracts\Likeable;
use Rennokki\Befriended\Traits\CanBeLiked;

class Post extends Model implements Likeable
{
    use CanBeLiked;

    protected $fillable = ['body', 'user_id'];
}
