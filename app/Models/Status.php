<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Task;

class Status extends Model
{
    protected $fillable = [
        'name'
    ];

    public function tasks(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
