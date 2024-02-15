<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driving extends Model
{
    use HasFactory;

    const RED_TIME = 5000;
    const YELLOW_TIME = 2000;
    const GREEN_TIME = 5000;
    const TOTAL_TIME = self::RED_TIME + self::GREEN_TIME + 2 * self::YELLOW_TIME;

    const RED = 0;
    const YELLOW = 1;
    const GREEN = 2;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
