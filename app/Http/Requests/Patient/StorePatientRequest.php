<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'maiden_name' => ['nullable', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'zip' => ['required', 'string', 'max:20'],
            'birth_date' => ['required', 'date', 'before:today'],
            'birth_place' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'marital_status' => ['required', 'string', 'max:20'],
            'spouse_last_name' => ['nullable', 'string', 'max:255'],
            'spouse_first_name' => ['nullable', 'string', 'max:255'],
            'spouse_middle_name' => ['nullable', 'string', 'max:255'],
            'spouse_maiden_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_name' => ['required', 'string', 'max:255'],
            'emergency_contact_relationship' => ['required', 'string', 'max:100'],
            'emergency_contact_phone' => ['required', 'string', 'max:20'],
            'guardian_name' => ['nullable', 'string', 'max:255'],
            'guardian_phone' => ['nullable', 'string', 'max:20'],
            'height' => ['required', 'numeric', 'max:300'],
            'weight' => ['required', 'numeric', 'max:500'],
            'device_identifier' => ['required', 'string', 'max:100', 'unique:patients,device_identifier'],
        ];
    }
}
