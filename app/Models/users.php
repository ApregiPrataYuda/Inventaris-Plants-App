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
}
