<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiSmokeTest extends TestCase
{
    public function test_api_root_returns_ok_response(): void
    {
        $response = $this->getJson('/');

        $response->assertOk()
            ->assertJson([
                'name' => 'CeviCheck API',
                'status' => 'ok',
            ]);
    }
}

