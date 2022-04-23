<?php

namespace Tests\Feature;

use App\Models\Starship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StarshipsTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_list_of_ships()
    {
        Starship::factory()->create([
            "name" => "Devastator",
            "status" => "Operational"
        ]);

        Starship::factory()->create([
            "name" => "Red Five",
            "status" => "Damaged"
        ]);

        $response = $this->getJson('/api/starships');

        $response->assertExactJson([
            'data' => [
                [
                    "id" => 1,
                    "name" => "Devastator",
                    "status" => "Operational"
                ],
                [
                    "id" => 2,
                    "name" => "Red Five",
                    "status" => "Damaged"
                ]
            ]
        ]);
    }
}