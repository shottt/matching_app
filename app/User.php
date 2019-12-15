<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'occupation', 'profile_header', 'profile_detail', 'birthday', 'location', 'picture', 'review', 'block_user', 'delete_flag'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // バリデーション（項目は適当。別途、検討要）
    public static $rules = array(
        'name' => 'max:255',
        'email' => 'email|max:255',
        'profile_header' => 'max:255',
        'profile_detail' => 'max:255',
        'picture' => 'file|image',
    );

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
