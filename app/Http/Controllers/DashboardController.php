<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboards.admin');
    }

    public function bibliothecaire()
    {
        return view('dashboards.bibliothecaire');
    }

    public function lecteur()
    {
        return view('dashboards.lecteur');
    }
}
