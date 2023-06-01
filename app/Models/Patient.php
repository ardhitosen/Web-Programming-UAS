<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Patient extends Model implements Authenticatable
{
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_patient', 'patient_id', 'doctor_id')
            ->withPivot('reserved_at', 'review')
            ->withTimestamps();
    }
    public function getAuthIdentifierName()
    {
        return 'id';
    }
    
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
    
    public function getAuthPassword()
    {
        return $this->password;
    }
    
    public function getRememberToken()
    {
       
    }
    
    public function setRememberToken($value)
    {
        
    }
    
    public function getRememberTokenName()
    {
        
    }
    

}