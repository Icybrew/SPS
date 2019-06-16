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
        'visit_at'
    ];
}
