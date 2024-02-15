<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \DateTime start_at
 */
class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $dates = [
        'start_at',
    ];

    protected $casts = [
        'start_at' => 'datetime'
    ];

    /**
     * Returns Last start at record, creates new if not exists
     * @return \DateTime
     */
    public static function getStartAt(): \DateTime
    {
        $settings = Settings::orderBy('id', 'desc')->first();

        if (!$settings) {
            $settings = new Settings();
            $settings->start_at = Carbon::now();
            $settings->save();
        }

        return $settings->start_at;
    }
}
