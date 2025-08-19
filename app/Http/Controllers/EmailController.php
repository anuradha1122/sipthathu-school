<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function testMailSend()
    {
        $data = ['message' => 'This is a test email from Laravel 12 using Gmail SMTP.'];
        Mail::to('prasadchmr@gmail.com')->send(new TestMail($data));
        return 'Email sent successfully!';
    }
}
