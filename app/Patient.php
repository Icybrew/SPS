<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    protected $fillable = [
        'patient_id',
        'doctor_id'
    ];

    public function patient() {
        return $this->belongsTo('SPS\User', 'patient_id', 'id');
    }

    public function doctor() {
        return $this->belongsTo('SPS\User', 'doctor_id', 'id');
    }

}
