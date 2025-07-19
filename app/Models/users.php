<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
   
    use HasFactory;
  
    protected $table = 'ms_user';
    protected $primaryKey = 'id_user';
    public $incrementing = true;
     protected $fillable = [
        'fullname',
        'username',
        'image',
        'password',
        'role_id',
        'is_active'
    ];


     public static function isUsernameExistsAdd($username)
    {
        return self::where('username', $username)->exists();
    }

    public static function isUsernameExistsEdit($username, $excludeId = null)
    {
        return self::where('username', $username)
            ->where('id_user', '!=', $excludeId)
            ->exists();
    }
}
