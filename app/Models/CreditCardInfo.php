<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCardInfo extends Model
{
    // explicitly define table and primary key
    protected $table = 'credit_card_info';
    protected $primaryKey = 'credit_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'credit_id', 'cardholder_name', 'card_number', 'payment_types', 'expiration_date_mm', 'cvv', 'address',
        'zip_code', 'user_id', 'expiration_date_yy'
    ];
}
