<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class PatientPrescriptionPurchase extends Model
{
    protected $table = 'patient_prescription_purchases';

    protected $fillable = [
        'patient_prescription_id',
        'pharmacist_id',
        'purchased_at'
    ];

    protected $casts = [
        'purchased_at' => 'datetime'
    ];

    public function prescription()
    {
        return $this->belongsTo('SPS\PatientPrescription', 'patient_prescription_id', 'id');
    }

    public function pharmacist()
    {
        return $this->hasOne('SPS\User', 'id', 'pharmacist_id');
    }
}
