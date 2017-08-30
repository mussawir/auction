<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    // explicitly define table and primary key
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'products_id', 'qty','price','pra_id','pa_id','address','credit_id','shipping_id'
    ];

    public function products_id()
    {
        return $this->belongsTo('App\Models\Products', 'products_id');
    }
}
