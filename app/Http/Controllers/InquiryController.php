<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function inquiry()
    {
        return view('Inquiry.inquiry');
    }
}
