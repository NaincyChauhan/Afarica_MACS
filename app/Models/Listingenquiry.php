<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listingenquiry extends Model
{
    use HasFactory;
    public function listing()
    {
        return $this->belongsTo('App\Models\Listing');
    }
}
