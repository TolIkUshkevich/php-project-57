<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    public function testStatusCreate(): void
    {
        $response = $this->post(route('status.create'), ['name' => 'new']);
        
        $response->assertStatus(302);

        $response = $this->post(route('status.create'), ['name' => 'new']);

        $response->assertStatus(302);
    }
}
