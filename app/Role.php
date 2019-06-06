<?php

namespace SPS;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    protected $fillable = [
        'name'
    ];
    
    public function users() {
        return $this->belongsToMany('SPS\User', 'user_roles');
    }
    
}
