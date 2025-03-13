<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Task;

class Status extends Model
{

    protected $table = 'statuses';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
        'updated_at' => 'datetime:d.m.Y',
    ];

    public function tasks(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
