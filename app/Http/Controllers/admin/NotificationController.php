<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
  public function markAsRead($id)
  {
    $notification = auth()->user()->unreadNotifications->where('id', $id)->first();
    if ($notification) {
      $notification->markAsRead();
    }
    return redirect()->route('admin.job');
  }
}
