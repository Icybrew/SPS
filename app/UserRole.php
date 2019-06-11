<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    protected $fillable = [
        'user_id',
        'role_id'
    ];

    public function user()
    {
        $this->belongsTo('SPS\User');
    }

    public function role()
    {
        $this->belongsTo('SPS\Role');
    }
}
