<?php

namespace SPS;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('SPS\Role', 'user_roles');
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function extraInfoPatient()
    {
        return $this->hasOne('SPS\ExtraInfoPatient', 'patient_id', 'id');
    }

    public function extraInfoDoctor()
    {
        return $this->hasOne('SPS\ExtraInfoDoctor', 'doctor_id', 'id');
    }

    public function extraInfoPharmacist()
    {
        return $this->hasOne('SPS\ExtraInfoPharmacist', 'pharmacist_id', 'id');
    }

    public function patients()
    {
        return $this->hasMany('SPS\Patient', 'doctor_id', 'id');
    }

    public function doctors()
    {
        return $this->hasMany('SPS\Patient', 'patient_id', 'id');
    }

}
