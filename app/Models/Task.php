<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Status;
use App\Models\Label;
use App\Models\User;

class Task extends Model
{
    protected $table = 'tasks';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'status_id',
        'created_by_id',
        'assigned_to_id'
    ];

    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function performer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_id', 'id')
            ->withDefault(function () {
                return new User([
                    'name' => '',
                    'email' => ''
                ]);
            });
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class);
            // ->withDefault(function (){
            //     return new Label([
            //         'name' => ''
            //     ]);
            // });
    }
}
