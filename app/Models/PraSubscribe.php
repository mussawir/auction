<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PraSubscribe extends Model
{
    // explicitly define table and primary key
    protected $table = 'pra_subscribe';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_msg', 'isApproved', 'pra_id', 'pa_id','store_code'
    ];

    
}
