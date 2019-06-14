<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{

    protected $fillable = [
        'name'
    ];

    public function doctor()
    {
        return $this->belongsTo('SPS\ExtraInfoDoctor', 'specialization_id', 'id');
    }

}
