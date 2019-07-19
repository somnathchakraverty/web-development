<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealUserManagement extends Model  {
    
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'deal_user_management';
    
    public static function getUserDetailByEncyUserId($EncryptUserId, $select = ['*']){
        $data = self::select($select)->whereRaw("md5(CONCAT(unique_salt, user_id)) = '$EncryptUserId'")->first();
        return $data;        
    }
    
    public static function getUserDetailByUserId($userId, $select = ['*']){
        $data = self::select($select)->where(['user_id' => $userId])->first();
        return $data;        
    }
}