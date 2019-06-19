<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class MedicalSubstance extends Model
{
    protected $table = 'medical_substances';

    protected $fillable = [
        'name',
    ];

    public function prescriptions()
    {
        return $this->hasMany('SPS\PatientPrescription', 'medical_substance_id', 'id');
    }
}
