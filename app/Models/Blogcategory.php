<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogcategory extends Model
{
    use HasFactory;

    public function blog()
    {
        return $this->hasMany('App\Models\Blog');
    }
}
