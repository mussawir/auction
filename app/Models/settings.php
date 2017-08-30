<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'key', 'value','user_id','settings_image'];


}
