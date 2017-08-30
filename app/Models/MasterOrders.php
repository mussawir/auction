<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterOrders extends Model
{
    // explicitly define table and primary key
    protected $table = 'master_orders';
    protected $primaryKey = 'm_id';
    public $timestamps = true;
	
	 protected $fillable = [
        'm_id', 'created_at', 'updated_at', 'm_pa_id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


}
