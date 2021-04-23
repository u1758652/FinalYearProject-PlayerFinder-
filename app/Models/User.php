<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Likable;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "personaname",
        "avatar",
        "steamid",
        "competitive_rank",
        "username",
        "roles",
        "likee_id",
        "user_id"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsToMany(Role::class);
    }

    public function sent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function received()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }


    public function forwardMessageTo($recipient, $message)
    {
        return $this->sent()->create([
            'receiver_id' => $recipient,
            'text' => $message,
        ]);
    }

}
