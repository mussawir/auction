<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class imageTable extends Model
{
    // explicitly define table and primary key
    protected $table = 'imageTable';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','image_path', 'refId', 'table','pixle'
    ];

}
