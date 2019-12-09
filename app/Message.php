<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function chat()
    {
        return $this->belongsTo('App\Chat');
    }
    protected $fillable = [
        'chat_id', 'to_user', 'from_user', 'attachment',
    ];

    //send_dateはcreated_atと同じじゃないですか？
}
