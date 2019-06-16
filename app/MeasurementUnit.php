<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class MeasurementUnit extends Model
{
    protected $fillable = [
        'unit'
    ];

    public function medicalSubstances()
    {
        return $this->hasMany('SPS\MedicalSubstance', 'measurement_unit_id', 'id');
    }
}
