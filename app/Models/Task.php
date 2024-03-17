<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status'
    ];

    // Define an array of task statuses as constants
    const STATUSES = [
        'todo' => 'To Do',
        'done' => 'Done',
        'in_progress' => 'In Progress',
        'close' => 'Closed'
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
