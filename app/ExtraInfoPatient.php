<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class ExtraInfoPatient extends Model
{

    protected $table = 'extra_info_patient';

    protected $fillable = [
        'personal_identification_code'
    ];

    public function user()
    {
        return $this->belongsTo('SPS\User', 'id');
    }

}
