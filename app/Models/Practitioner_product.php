<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practitioner_product extends Model
{
    // explicitly define table and primary key
    protected $table = 'Practitioner_product';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id', 'product_id', 'discountP', 'start_date', 'end_date','pra_price'
    ];

    
}
