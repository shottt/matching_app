<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'chat_id', 'to_user', 'from_user', 'attachment',
    ];
}
