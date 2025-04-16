<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'height',
        'weight',
        'device_identifier'
    ];

    public function sensorsValue()
    {
        return $this->hasMany(SensorsValue::class);
    }
}
