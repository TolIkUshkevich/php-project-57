<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Policies\StatusPolicy;
use App\Policies\LabelPolicy;
use App\Policies\TaskPolicy;
use App\Models\Status;
use App\Models\Label;
use App\Models\Task;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Status::class => StatusPolicy::class,
        Label::class => LabelPolicy::class,
        Task::class => TaskPolicy::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
