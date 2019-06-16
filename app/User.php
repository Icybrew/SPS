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
        'firstname', 'lastname', 'birthday', 'email', 'password',
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

    public function isAdmin()
    {
        return $this->hasRole(config('roles.name.admin'));
    }

    public function isDoctor()
    {
        return $this->hasRole(config('roles.name.doctor'));
    }

    public function isPatient()
    {
        return $this->hasRole(config('roles.name.patient'));
    }

    public function isPharmacist()
    {
        return $this->hasRole(config('roles.name.pharmacist'));
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
        return $this->hasManyThrough('SPS\User', 'SPS\Patient', 'doctor_id', 'id', 'id', 'patient_id');
    }

    public function doctors()
    {
        return $this->hasManyThrough('SPS\User', 'SPS\Patient', 'patient_id', 'id', 'id', 'doctor_id');
    }

    public function medicalHistory()
    {
        return $this->hasMany('SPS\PatientMedicalHistory', 'patient_id', 'id');
    }
}
