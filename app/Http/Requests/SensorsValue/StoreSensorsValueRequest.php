<?php

namespace App\Http\Requests\SensorsValue;

use Illuminate\Foundation\Http\FormRequest;

class StoreSensorsValueRequest extends FormRequest
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
            'bpm' => ['required', 'numeric'],
            'device_identifier' => ['required','exists:patients,device_identifier'],
        ];
    }
}
