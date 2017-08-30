<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSentReciptent extends Model
{
    // explicitly define table and primary key
    protected $table = 'email_sent_recipent';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email_id', 'first_name', 'last_name', 'email_address', 'created_by', 'type', 'phone_number'
    ];
}
