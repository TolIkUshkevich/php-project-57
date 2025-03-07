<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    public function __setUp(): void
    {
        
    }

    public function testStatusCreate(): void
    {
        $response = $this->post('/task_status/create', ['name' => 'new']);
        
        
    }
}
