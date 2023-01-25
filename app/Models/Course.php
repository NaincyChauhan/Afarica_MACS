<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function coursecontent()
    {
        return $this->hasMany('App\Models\Coursecontent');
    }
    public function coursereview()
    {
        return $this->hasMany('App\Models\Coursereview');
    }

    public function usercourse()
    {
        return $this->hasMany(Usercourse::class);
    }
}
