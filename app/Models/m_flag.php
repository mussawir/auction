<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_flag extends Model
{
    protected $table = 'M_FLAG';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'FlagType', 'Flag','user_id'];


}
