<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';
    protected $primary = 'id';
    protected $fillable = [
        'to_user', 'from_user',
    ];
}