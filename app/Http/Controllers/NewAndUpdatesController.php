<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewAndUpdatesController extends Controller
{
    public function news()
    {
        return view('news-and_update.news-and-updates');
    }
}
