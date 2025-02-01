<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $hour = date('H');

        if ($hour >= 5 && $hour < 9) {
            $greeting = "Jó reggelt!";
        } elseif ($hour >= 9 && $hour < 18) {
            $greeting = "Jó napot!";
        } else {
            $greeting = "Jó estét!";
        }

        return view('dashboard', compact('greeting'));
    }
}
