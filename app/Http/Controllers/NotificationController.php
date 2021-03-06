<?php

namespace App\Http\Controllers;

use App\Enums\NotificationTypes;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(): View
    {
        $notifications = auth()->user()->notifications()->orderBy('id', 'DESC')->paginate(30);

        auth()->user()->markNotificationsAsRead();

        return view('notifications.index', compact('notifications'));
    }
}
