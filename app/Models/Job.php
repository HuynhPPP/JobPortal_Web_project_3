<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  use HasFactory;
  public function career()
  {
    return $this->belongsTo(Career::class);
  }
  public function jobType()
  {
    return $this->belongsTo(JobType::class);
  }
  protected $table = 'jobs';
  public function applications()
  {
    return $this->hasMany(JobApplication::class);
  }
}
