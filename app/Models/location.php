<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;
     protected $table = 'locations';
    protected $primaryKey = 'id_locations';
    public $incrementing = true;
    protected $fillable = [
        'name_locations',
        'description_locations'
    ];

    //cek apakah ada name yang sama  untuk add
    public static function isLocExists($name)
    {
        return self::where('name_locations', $name)->exists();
    }
    //cek apakah ada name  yang sama  untuk update
    public static function isisLocExistsupExists($name, $excludeId = null)
    {
        return self::where('name_locations', $name)
            ->where('id_locations', '!=', $excludeId)
            ->exists();
    }
}
