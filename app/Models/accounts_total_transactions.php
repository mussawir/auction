<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class accounts_total_transactions extends Model
{
    protected $table = 'accounts_total_transactions';
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'order_id','transaction_no','amount','type'];

}
