<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class proSuggestionsMaster extends Model
{
    // explicitly define table and primary key
    protected $table = 'pro_sugest_master';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pra_id', 'message'
    ];

    public function practitioner()
    {
        return $this->belongsTo('App\Models\Practitioner', 'pra_id');
    }
}