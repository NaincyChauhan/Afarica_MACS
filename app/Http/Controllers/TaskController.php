<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userapplication;
use Auth, Carbon\Carbon;

class TaskController extends Controller
{
    public function today()
    {
        return view('admin.tasks.today', [
            'applications' => Userapplication::where('staff_id', Auth::user()->staff()->first()->id)
            ->whereDate('assign_date', Carbon::now())->get()
        ]);
    }

    public function pending()
    {
        return view('admin.tasks.pending', [
            'applications' => Userapplication::where('staff_id', Auth::user()->staff()->first()->id)
            ->whereDate('assign_date', Carbon::now())
            ->where('status', '!=', 1)
            ->get()
        ]);
    }
    

    public function complete()
    {
        return view('admin.tasks.complete', [
            'applications' => Userapplication::where('staff_id', Auth::user()->staff()->first()->id)
            ->whereDate('assign_date', Carbon::now())
            ->where('status', 1)
            ->get()
        ]);
    }
}
