<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications_user', function (Blueprint $table) {
            $table->id();
            
            // Tạo cột 'user_id' làm khóa ngoại trỏ đến bảng 'users'
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            // Thêm cột 'job_id' làm khóa ngoại trỏ đến bảng 'job_applications'
            $table->foreignId('job_notification_id')->constrained('job_applications')->onDelete('cascade');
            
            // Thêm cột message để lưu nội dung thông báo
            $table->string('message'); 
            
            // Thêm cột type để phân loại loại thông báo (approved, rejected, v.v.)
            $table->enum('type', ['approved', 'rejected', 'limit_reached', 'expired', 'deleted']); 
            
            // Cột read_at để đánh dấu khi người dùng đã đọc thông báo
            $table->timestamp('read_at')->nullable(); 
            
            // Thêm cột thời gian tạo và cập nhật tự động
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications_user');
    }
};
