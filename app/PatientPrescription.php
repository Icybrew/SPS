<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class PatientPrescription extends Model
{
    protected $table = 'patient_prescriptions';

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'medical_substance_id',
        'substance_in_dose',
        'measurement_unit_id',
        'description',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'substance_in_dose' => 'double'
    ];

    public function doctor()
    {
        return $this->hasOne('SPS\User', 'id', 'doctor_id');
    }

    public function patient()
    {
        return $this->hasOne('SPS\User', 'id', 'patient_id');
    }
    
    public function medicalSubstance()
    {
        return $this->hasOne('SPS\MedicalSubstance', 'id', 'medical_substance_id');
    }

    public function MeasurementUnit()
    {
        return $this->hasOne('SPS\MeasurementUnit', 'id', 'measurement_unit_id');
    }

    public function purchases()
    {
        return $this->hasMany('SPS\PatientPrescriptionPurchase', 'patient_prescription_id', 'id');
    }
}
