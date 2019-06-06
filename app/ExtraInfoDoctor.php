<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class ExtraInfoDoctor extends Model
{

    protected $table = 'extra_info_doctor';

    protected $fillable = [
        'specialization'
    ];

    public function user()
    {
        return $this->belongsTo('SPS\User', 'id');
    }

}
