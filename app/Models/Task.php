<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Status;
use App\Models\User;

class Task extends Model
{
    protected $table = 'tasks';

    protected $primaryKey = 'task_id';

    protected $fillable = [
        'name',
        'description',
        'status_id',
        'created_by_id',
        'assigned_to_id'
    ];

    public function ststus(): HasOne
    {
        return $this->hasOne(Status::class);
    }

    public function createdBy(): HasOne
    {
        return $this->hasOne(User::class, 'created_by_id');
    }

    public function createdTo(): HasOne
    {
        return $this->hasOne(User::class, 'created_by_id');
    }
}
