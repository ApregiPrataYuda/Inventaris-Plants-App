<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
  
    protected $table = 'plant_categories';
    protected $primaryKey = 'id_category';
    public $incrementing = true;
    protected $fillable = [
        'name_category',
        'description'
    ];

    //cek apakah ada name yang sama  untuk add
    public static function isCateExists($name)
    {
        return self::where('name_category', $name)->exists();
    }

    //cek apakah ada name  yang sama  untuk update
    public static function isCateupExists($name, $excludeId = null)
    {
        return self::where('name_category', $name)
            ->where('id_category', '!=', $excludeId)
            ->exists();
    }
}
