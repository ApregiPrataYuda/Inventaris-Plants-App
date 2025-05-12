<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plants extends Model
{
    use HasFactory;
    protected $table = 'plants';
    protected $primaryKey = 'id_plants';
    public $incrementing = true;
    protected $fillable = [
        'name',
        'code_plants',
        'image',
        'scientific_name',
        'category_id',
        'location_id',
        'status',
        'planting_date',
        'notes',
    ];

     public static function isnameExists($name)
    {
        return self::where('name', $name)->exists();
    }

    public static function isnametwoExists($ascname)
    {
        return self::where('scientific_name', $ascname)->exists();
    }

}
