<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
        'comments'
    ];

    /**
     * Add comment to a user
     *
     * @param $user \App\Models\User model instance
     * @param $data array            data from form passed
     *
     * @return \App\Models\User
     */
    public static function add_comment($user, $data) {
        if (!empty($user)) {
            $comments = json_decode($user->comments);
            array_push($comments, $data['comment']);
            $user->comments = json_encode($comments);
            $user->update();
        }

        return $user;
    }
}
