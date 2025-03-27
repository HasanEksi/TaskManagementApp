<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
  use SoftDeletes, HasFactory;

  protected $fillable = [
    'title',
    'description',
    'priority',
    'status',
    'user_id',
    'completed_at',
  ];

  protected $casts = [
    'status' => TaskStatus::class,
    'priority' => TaskPriority::class,
    'completed_at' => 'datetime',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function scopePending($query)
  {
    return $query->where('status', TaskStatus::PENDING);
  }

  public function scopeInProgress($query)
  {
    return $query->where('status', TaskStatus::IN_PROGRESS);
  }

  public function scopeCompleted($query)
  {
    return $query->where('status', TaskStatus::COMPLETED);
  }

  public function scopeHighPriority($query)
  {
    return $query->where('priority', TaskPriority::HIGH);
  }

  public function scopeMediumPriority($query)
  {
    return $query->where('priority', TaskPriority::MEDIUM);
  }

  public function scopeLowPriority($query)
  {
    return $query->where('priority', TaskPriority::LOW);
  }

  public function scopeFilterByStatus($query, ?string $status)
  {
    if (!$status) {
      return $query;
    }

    return match ($status) {
      'pending' => $query->pending(),
      'in_progress' => $query->inProgress(),
      'completed' => $query->completed(),
      default => $query
    };
  }

  public function scopeFilterByPriority($query, ?string $priority)
  {
    if (!$priority) {
      return $query;
    }

    return match ($priority) {
      'high' => $query->highPriority(),
      'medium' => $query->mediumPriority(),
      'low' => $query->lowPriority(),
      default => $query
    };
  }

  public function scopeFilterByUser($query, int $userId)
  {
    return $query->where('user_id', $userId);
  }

  protected static function boot()
  {
    parent::boot();

    static::updating(function ($task) {
      if ($task->isDirty('status') && $task->status === TaskStatus::COMPLETED) {
        $task->completed_at = now();
      }
    });
  }
}
