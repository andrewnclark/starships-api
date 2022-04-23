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

    public function test_can_filter_starships_by_name()
    {
        $devastators = Starship::factory(2)->create([
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
                    "id" => $devastators[0]->id,
                    "name" => "Devastator",
                    "status" => "Operational"
                ],
                [
                    "id" => $devastators[1]->id,
                    "name" => "Devastator",
                    "status" => "Operational"
                ]
            ]
        ]);

        $response->assertJsonMissing([
            'name' => 'Red Five',
            'status' => 'Damaged'
        ]);
    }
}