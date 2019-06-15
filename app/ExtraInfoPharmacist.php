<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class ExtraInfoPharmacist extends Model
{

    protected $table = 'extra_info_pharmacist';

    protected $fillable = [
        'pharmacist_id',
        'workplace',
    ];

    public function user()
    {
        return $this->belongsTo('SPS\User', 'id', 'pharmacist_id');
    }

}
