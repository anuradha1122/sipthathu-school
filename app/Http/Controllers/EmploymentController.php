<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    public function employment()
    {
        return view('employer.employment');
    }
}
