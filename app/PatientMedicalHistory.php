<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class PatientMedicalHistory extends Model
{
    protected $table = 'patient_medical_history';

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'disease_code',
        'description',
        'visit_duration',
        'visit_compensated',
        'visit_repeated',
        'visited_at'
    ];

    protected $casts = [
        'visit_compensated' => 'boolean',
        'visit_repeated' => 'boolean',
        'visited_at' => 'datetime',
    ];

    public function doctor()
    {
        return $this->hasOne('SPS\User', 'id', 'doctor_id');
    }

    public function patient()
    {
        return $this->hasOne('SPS\User', 'id', 'patient_id');
    }
}
