<?php

namespace App\Http\Controllers;

use App\DataTables\MedicalHistoryDataTable;
use App\Http\Requests\MedicalHistory\StoreMedicalHistoryRequest;
use App\Http\Requests\MedicalHistory\UpdateMedicalHistoryRequest;
use App\Models\MedicalHistory;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MedicalHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MedicalHistoryDataTable $dataTable)
    {
        $patient = Patient::find(array_key_first(request()->query()));

        return $dataTable->render('medical-history.index', compact('patient'));
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
    public function store(StoreMedicalHistoryRequest $request)
    {
        $medicalHistory = MedicalHistory::create($request->validated());

        alert()->success('Medical history created successfully');

        return redirect()->route('medical-history.index', $medicalHistory->patient_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalHistory $medicalHistory): JsonResponse
    {
        return response()->json($medicalHistory);
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
    public function update(UpdateMedicalHistoryRequest $request, MedicalHistory $medicalHistory)
    {
        $medicalHistory->update($request->validated());

        alert()->success('Medical history updated successfully');

        return redirect()->route('medical-history.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalHistory $medicalHistory)
    {
        $medicalHistory->delete();

        alert()->success('Medical history deleted successfully');
        
        return redirect()->route('medical-history.index');
    }
}
