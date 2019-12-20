<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'chat_id', 'to_user', 'from_user', 'detail', 'attachment', 'delete_flag',
    ];
    // バリデーション処理
    public static $rules = array(
        'comment' => 'required|max:255',
        'attachment' => 'file|image|',
    );

    public function chat()
    {
        return $this->belongsTo('App\Chat');
    }
}
