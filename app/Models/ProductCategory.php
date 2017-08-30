<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    // explicitly define table and primary key
    protected $table = 'categories';
    protected $primaryKey = 'cat_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cat_name', 'parent_id', 'sortOrder','cat_image','cat_percentage','cat_desc'
    ];

}
