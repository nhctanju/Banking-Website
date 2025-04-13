<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dash()
    {
        // Your dashboard logic here
        return view('dashboard');
    }

}
