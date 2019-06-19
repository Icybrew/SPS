<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class MeasurementUnit extends Model
{
    protected $fillable = [
        'unit'
    ];

    public function prescriptions()
    {
        return $this->hasMany('SPS\PatientPrescription', 'measurement_unit_id', 'id');
    }
}
