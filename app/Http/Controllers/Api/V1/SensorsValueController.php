<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SensorsValue\StoreSensorsValueRequest;
use App\Models\Patient;
use App\Models\SensorsValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SensorsValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json('get');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSensorsValueRequest $request): JsonResponse
    {
        try {
            $patient = Patient::where('device_identifier', $request->device_identifier)->first();
            
            $sensor = SensorsValue::create($request->except('device_identifier') + [
                'patient_id' => $patient->id,
            ]);
            return response()->json([
                'message' => 'Sensor Value Stored Successfully!',
                'sensor_value' => $sensor
            ], Response::HTTP_CREATED); 
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to store sensor value.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
