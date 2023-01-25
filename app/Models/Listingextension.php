<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listingextension extends Model
{
    use HasFactory;

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function extension()
    {
        return $this->belongsTo(Extension::class);
    }

    public function subextension()
    {
        return $this->belongsTo(Subextension::class);
    }
}
