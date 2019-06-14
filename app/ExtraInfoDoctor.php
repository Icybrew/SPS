<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class ExtraInfoDoctor extends Model
{

    protected $table = 'extra_info_doctor';

    protected $fillable = [
        'doctor_id',
        'specialization_id'
    ];

    public function user()
    {
        return $this->belongsTo('SPS\User', 'id');
    }

    public function specialization()
    {
        return $this->hasOne('SPS\Specialization', 'id', 'specialization_id');
    }
}
