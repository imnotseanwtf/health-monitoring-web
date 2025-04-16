<?php

namespace App\Http\Controllers\Web;

use App\DataTables\PatientDataTable;
use App\Enums\GenderType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PatientDataTable $patientDataTable)
    {
        return $patientDataTable->render('patient.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request): RedirectResponse
    {
        Patient::create($request->validated());

        alert()->success('Patien Stored Successfully!');

        return redirect()->route('patient.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $patient->load('sensorsValue');

        return view('patient.show', compact('patient'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient): RedirectResponse
    {
        $patient->update($request->validated());

        alert()->success('Patient Updated Successfully!');

        return redirect()->route('patient.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient): RedirectResponse
    {
        $patient->delete();
    
        alert()->success('Patient Deleted Successfully!');

        return redirect()->route('patient.index');
    }
}
