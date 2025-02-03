<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $hour = date('H');

        if ($hour >= 5 && $hour < 10) {
            $greeting = __('messages.greetings.morning');
        } elseif ($hour >= 10 && $hour < 18) {
            $greeting = __('messages.greetings.afternoon');
        } elseif ($hour >= 18 && $hour < 22) {
            $greeting = __('messages.greetings.evening');
        } else {
            $greeting = __('messages.greetings.night');
        }

        return view('dashboard', compact('greeting'));
    }
}
