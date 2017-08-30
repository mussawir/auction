<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notes extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'pra_id', 'pa_id', 'note_text'];

}
