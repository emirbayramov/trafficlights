<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Services\DrivingService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DrivingController extends Controller
{

    public function index()
    {
        $start_at = Carbon::parse(Settings::getStartAt())->toISOString();

        return view('index', compact("start_at"));
    }

    /**
     * Records traffic light color when driving for each session
     * If there is no such user, then creates
     * Returns traffic light color number (0 - red, 1 - yellow, 3 - green)
     *
     * @param Request $request
     * @param DrivingService $drivingService
     * @return array
     */
    public function drive(Request $request, DrivingService $drivingService): array
    {
        return $drivingService->drive($request->session()->getId());
    }
}
