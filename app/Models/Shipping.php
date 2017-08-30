<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    // explicitly define table and primary key
    protected $table = 'shipping_address';
    protected $primaryKey = 's_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','phone','address','zip_code','pa_id'
    ];

}
