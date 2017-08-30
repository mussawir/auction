<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class proSuggestionsDetails extends Model
{
    // explicitly define table and primary key
    protected $table = 'pro_sugest_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_id', 'pa_id', 'products_id'
    ];


    public function supSuggestionsMaster()
    {
        return $this->belongsTo('App\Models\SupSuggestionsMaster', 'id');
    }
}
