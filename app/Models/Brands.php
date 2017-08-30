<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'Brands';
    protected $primaryKey = 'id';

    protected $fillable = ['brandName', 'brandDescriptiion', 'supplier_id'];
}
