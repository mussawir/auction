<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    // explicitly define table and primary key
    protected $table = 'notifications';
    protected $primaryKey = 'not_id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'not_link', 'not_details','user_id','not_image','not_type'
    ];
}
