<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function setLocale($lang){
        if(in_array($lang, ['en', 'es', 'fr', 'de', 'hu'])){
            App::setLocale($lang);
            Session::put('locale', $lang);
        }

        return back();
    }
}
