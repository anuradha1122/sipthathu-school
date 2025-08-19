<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $students = [
            'sabaragamuwa' => 10100,
            'western' => 10100,
            'central' => 10100,
            'southern' => 10100,
            'eastern' => 10100,
            'northern' => 10100,
            'uva' => 10100,
            'north-western' => 10100,
            'north-central' => 10100,
        ];

        $data = [
            'teacher' => [
                'male' => 200000,
                'female' => 300000,
            ],
            'student' => [
                'male' => 2000000,
                'female' => 3000000,
            ],
        ];

        return view('dashboard', compact('students', 'data'));
    }
}
