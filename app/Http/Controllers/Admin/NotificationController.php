<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Notifications Page
     */
    public function index()
    {
        $notifications = auth()
            ->user()
            ->notifications()
            ->latest()
            ->paginate(15);

        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Mark Single Notification As Read
     */
    public function markAsRead($id)
    {
        $notification = auth()
            ->user()
            ->notifications()
            ->findOrFail($id);

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return back()->with('success', 'Notification marked as read.');
    }

    /**
     * Mark All Notifications As Read
     */
    public function markAllAsRead()
    {
        auth()
            ->user()
            ->unreadNotifications
            ->markAsRead();

        return back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Delete Notification
     */
    public function destroy($id)
    {
        $notification = auth()
            ->user()
            ->notifications()
            ->findOrFail($id);

        $notification->delete();

        return back()->with('success', 'Notification deleted successfully.');
    }
    public function deleteAll()
    {
        $notification = auth()
            ->user()
            ->notifications();

        $notification->delete();

        return back()->with('success', 'Notification deleted successfully.');
    }

       public function readAndRedirect($notiId, $desinationRoute)
    {
        $student = Auth::user();
        $notification = $student->notifications()
            ->where('id', $notiId)
            ->firstOrFail();
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }
        return redirect()->to(base64_decode($desinationRoute));
    }
    
}
