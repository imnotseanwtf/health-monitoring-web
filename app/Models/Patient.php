<?php

namespace App\Models;

use App\Enums\MaritalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name', 
        'middle_name',
        'maiden_name',
        'address',
        'city',
        'province',
        'zip',
        'birth_date',
        'birth_place',
        'phone',
        'marital_status',
        'spouse_last_name',
        'spouse_first_name',
        'spouse_middle_name',
        'spouse_maiden_name',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_phone',
        'guardian_name',
        'guardian_phone',
        'height',
        'weight',
        'device_identifier'
    ];

    public function casts()
    {
        return [
            'marital_status' => MaritalStatus::class,
        ];
    }

    public function sensorsValue()
    {
        return $this->hasMany(SensorsValue::class);
    }

    public function medicalHistories(): HasMany
    {
        return $this->hasMany(MedicalHistory::class);
    }
}
