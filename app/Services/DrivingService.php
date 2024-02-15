<?php

namespace App\Services;

use App\Models\Driving;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;

class DrivingService {


    /**
     * Records traffic light color when driving for each session
     * If there is no such user, then creates
     * Returns traffic light color number (0 - red, 1 - yellow, 3 - green)
     *
     * @param string $session
     * @return array
     */
    public function drive(string $session)
    {

        $start_at = Settings::getStartAt();

        $user = User::getBySession($session);

        $milliseconds = Carbon::now()->diffInMilliseconds($start_at);

        $milliseconds = $milliseconds % Driving::TOTAL_TIME;

        $color = Driving::GREEN;
        $is_after_green = false;
        if($milliseconds < Driving::YELLOW_TIME){
            $color = Driving::YELLOW;
            $is_after_green = true;
        } elseif ($milliseconds < Driving::RED_TIME + Driving::YELLOW_TIME) {
            $color = Driving::RED;
        } elseif ($milliseconds < (Driving::RED_TIME + 2 * Driving::YELLOW_TIME)) {
            $color = Driving::YELLOW;
        }

        $driving = new Driving();
        $driving->user_id = $user->id;
        $driving->color = $color;

        $driving->save();


        return [
            'color' => $color,
            'is_after_green' => $is_after_green
        ];
    }

}
