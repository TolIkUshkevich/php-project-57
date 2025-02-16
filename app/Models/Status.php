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

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
