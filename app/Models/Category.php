<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function listing()
    {
        return $this->hasMany(Listing::class);
    }
}
