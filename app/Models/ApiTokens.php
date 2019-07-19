<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class ApiTokens extends Authenticatable {
    
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'api_tokens';
    
    protected $remember_token = null;
    
    protected $salt_uid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'token', 'salt_uid'
    ];
    
    public function getAuthPassword() {
        return $this->token;
    }
    
    public function getRememberToken()
    {
      return null; // not supported
    }

    public function setRememberToken($value)
    {
      // not supported
    }

    public function getRememberTokenName()
    {
      return null; // not supported
    }

    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value)
    {
      $isRememberTokenAttribute = $key == $this->getRememberTokenName();
      if (!$isRememberTokenAttribute)
      {
        parent::setAttribute($key, $value);
      }
    }

    // User model
    public function getSaltUidAttribute() 
    {
        return $this->salt_uid;
    }
    
    public function setSaltUidAttribute($value)
    {
        $this->attributes['salt_uid'] = strtolower($value);
    }

    public static function getIdByCondi($condition, $select = ['*']){
        $data = self::select($select)->where($condition)->first();
        return $data;
        
    }
}