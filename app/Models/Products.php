<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'products_id';

    protected $fillable = ['products_id','products_name', 'productDescription','short_description','createdBy', 'supplier_id','cat_id','price','discountPer','map','taxPer','quantity','status','featured','tags','brand_id','mainImage','profitP','SKU'];

    public function products_id()
    {
        return $this->hasMany('App\Models\Carts', 'products_id');
    }
}

