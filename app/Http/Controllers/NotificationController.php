<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

use Illuminate\Support\Facades\Notification;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index()
    {
        // Ensure user is logged in before accessing notifications
        if (!Auth::check()) {
            return back()->with('error', 'User not authenticated.');
        }

        // Fetch unread notifications for the authenticated user
        $notifications = Auth::user()->unreadNotifications ?? collect();

        return view('futsal_owner.pages.notifications.allnotification', compact('notifications'));
    }

    public function confirm($notificationId)
    {
        // Find the notification by its ID
        $notification = DatabaseNotification::findOrFail($notificationId);

        // Perform the confirmation logic (e.g., mark the notification as read)
        $notification->update(['read_at' => now()]);

        // Redirect back to the all notifications page
        return redirect()->route('futsal_owner.notifications.allnotification');
    }

    public function cancel($notificationId)
    {
        // Find the notification by its ID
        $notification = DatabaseNotification::findOrFail($notificationId);

        // Perform the cancellation logic (e.g., delete the notification)
        $notification->delete();

        // Redirect back to the all notifications page
        return redirect()->route('futsal_owner.notifications.allnotification');
    }

    public function markAsRead($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $notification = DatabaseNotification::findOrFail($id);

        // Verify the notification belongs to the authenticated user
        if ($notification->notifiable_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        $notification->markAsRead();

        return back()->with('success', 'Notification dismissed');
    }
}
