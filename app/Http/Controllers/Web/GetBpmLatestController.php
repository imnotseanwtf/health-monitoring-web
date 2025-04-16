<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class GetBpmLatestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Patient $patient)
    {
        $latestSensorValue = $patient->sensorsValue()->latest('created_at')->first();

        $bpm = $latestSensorValue->bpm;

        return response()->json([
            'bpm' => $bpm
        ]);
    }
}
