<?php

namespace App\Http\Controllers;

use App\Models\WorkHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {

        $wh = WorkHours::where('user_id', 1)->first();

        var_dump(
            $wh->workedHours(),
            $wh->exitTime()
        );
    }
}
