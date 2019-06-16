<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class MedicalSubstance extends Model
{
    protected $table = 'medical_substances';

    protected $fillable = [
        'name',
        'substance_in_dose',
        'measurement_unit_id'
    ];

    public function measurementUnit()
    {
        return $this->hasOne('SPS\MeasurementUnit', 'id', 'measurement_unit_id');
    }
}
