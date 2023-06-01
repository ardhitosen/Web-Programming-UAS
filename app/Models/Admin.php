<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Admin extends Model implements Authenticatable
{
   
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