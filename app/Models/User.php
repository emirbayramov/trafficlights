<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string session_id
 * @property Driving[] drivings
 */
class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'session_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    public function drivings()
    {
        return $this->hasMany(Driving::class);
    }

    /**
     * Returns user by session id, creates new if not exists
     * @return User
     */
    public static function getBySession(string $session): User
    {
        $user = User::where('session_id', $session)
            ->first();

        if (!$user) {
            $user = new User();
            $user->session_id = $session;
            $user->save();
        }

        return $user;
    }
}
