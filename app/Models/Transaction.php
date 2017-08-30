<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // explicitly define table and primary key
    protected $table = 'transaction';
    protected $primaryKey = 'tr_id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_number', 'order_id', 'user_id','amount','shipping_address','payment_id','card_customer_name','card_type','card_number','card_cvc','card_exp_month','card_exp_year','card_auth_code','payment_status'
    ];



}
