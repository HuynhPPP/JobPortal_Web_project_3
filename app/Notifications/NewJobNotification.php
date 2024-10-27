<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class NewJobNotification extends Notification
{
  use Queueable;

  protected $job;

  public function __construct($job)
  {
    $this->job = $job;
  }

  public function via($notifiable)
  {
    return ['database']; // Lưu thông báo trong cơ sở dữ liệu
  }

  public function toDatabase($notifiable)
  {
    return [
      'title' => 'Công việc mới được thêm',
      'message' => 'Nhà tuyển dụng vừa thêm một công việc mới.',
      'url' => route('admin.job'), // Đường dẫn đến danh sách công việc của admin
      'job_id' => $this->job->id, // Lưu ID công việc nếu cần thiết
    ];
  }
}
