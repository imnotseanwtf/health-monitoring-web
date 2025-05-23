<?php

namespace App\Http\Requests\MedicalHistory;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalHistoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'exists:patients,id'],
            'medical_problems' => ['required', 'string'],
            'list_all_allergies' => ['required', 'string'],
            'list_all_medications' => ['required', 'string'],
        ];
    }
}
