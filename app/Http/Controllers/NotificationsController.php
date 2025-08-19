<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function notifications()
    {
        $notifications = [
            (object)[
                'title' => 'New Assignment',
                'author' => 'John Doe',
                'created_at' => now()->subMinutes(10),
                'message' => 'You have been assigned to review the latest project proposal.'
            ],
            (object)[
                'title' => 'Server Maintenance',
                'author' => 'Admin',
                'created_at' => now()->subHours(2),
                'message' => 'The server will be down for maintenance at midnight.'
            ],
            (object)[
                'title' => 'New Comment',
                'author' => 'Jane Smith',
                'created_at' => now()->subDays(1),
                'message' => 'Jane Smith commented on your post.'
            ]
        ];
        return view('notifications.notifications-list', compact('notifications'));
    }
}
