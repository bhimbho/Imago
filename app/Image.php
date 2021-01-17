<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // only data to be permitted by the model for save
    protected $fillable = ['title',
    'price',
    'discount',
    'image_file',
    'permission',
    'user_id',
    'size'];
}
