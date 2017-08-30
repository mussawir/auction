<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // explicitly define table and primary key
    protected $table = 'cart';
    protected $primaryKey = 'cart_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'products_id', 'qty', 'pa_id','pra_id'
    ];

    public function products_id()
    {
        return $this->belongsTo('App\Models\Products','products_id');
    }
}
