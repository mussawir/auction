<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class accounts_transaction extends Model
{
    protected $table = 'accounts_transaction';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'user_id', 'order_id', 'products_id','amount'];

}
