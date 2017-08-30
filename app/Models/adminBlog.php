<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class adminBlog extends Model
{
    protected $table = 'adminBlog';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'blog_text', 'type','created_by','blog_title','image_path','post_link'];

}
