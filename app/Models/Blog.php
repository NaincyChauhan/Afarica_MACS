<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public function blogcategory()
    {
        return $this->belongsTo('App\Models\Blogcategory');
    }
}
