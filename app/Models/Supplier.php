<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    // explicitly define table and primary key
    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'email', 'first_name','last_name','supplierDescription','phone','address'
    ];

    public function supplier()
    {
        return $this->hasMany('App\Models\products', 'supplier_id');
    }

}
