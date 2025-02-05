<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'due_date'];

    // Scope for filtering pending tasks
    public function scopePending(Builder $query)
    {
        return $query->where('status', 'pending');
    }

    // Scope for filtering completed tasks
    public function scopeCompleted(Builder $query)
    {
        return $query->where('status', 'completed');
    }

    // Scope for tasks due in the next 3 days
    public function scopeDueSoon(Builder $query)
    {
        return $query->where('due_date', '<=', Carbon::now()->addDays(3));
    }
}
