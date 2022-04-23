<?php

namespace Tests\Feature;

use App\Models\Armament;
use App\Models\Starship;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
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

        $response = $this->getJson('/api/starships?name=Devastator');

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

    public function test_can_filter_starships_by_status()
    {
        Starship::factory(2)->create([
            "name" => "Devastator",
            "status" => "Operational"
        ]);

        $damaged = Starship::factory()->create([
            "name" => "Red Five",
            "status" => "Damaged"
        ]);

        $response = $this->getJson('/api/starships?status=damaged');

        $response->assertExactJson([
            'data' => [
                [
                    'id' => $damaged->id,
                    'name' => 'Red Five',
                    'status' => 'Damaged'
                ]
            ]
        ]);
    }

    public function test_can_view_a_single_starship()
    {
        $ship = Starship::factory()->create([
            'name' => 'Devastator',
            'class' => 'Star Destroyer',
            'crew' => 35000,
            'image' => 'https://url.to.image',
            'value' => 1999.99,
            'status' => 'operational',
        ]);

        $laser = Armament::factory()->create(['title' => 'Turbo Laser']);
        $cannon = Armament::factory()->create(['title' => 'Ion Cannons']);
        $beam = Armament::factory()->create(['title' => 'Tractor Beam']);

        $ship->armaments()->attach($laser->id, ['quantity' => 60]);
        $ship->armaments()->attach($cannon->id, ['quantity' => 60]);
        $ship->armaments()->attach($beam->id, ['quantity' => 60]);

        $response = $this->getJson("/api/starships/{$ship->id}");

        $response->assertExactJson([
            'id' => $ship->id,
            'name' => 'Devastator',
            'class' => 'Star Destroyer',
            'crew' => 35000,
            'image' => 'https://url.to.image',
            'value' => 1999.99,
            'status' => 'operational',
            'armament' => [
                [
                    "title" => "Turbo Laser",
                    "qty" => 60,
                ],
                [
                    'title' => 'Ion Cannons',
                    'qty' => 60                    
                ],
                [
                    'title' => 'Tractor Beam',
                    'qty' => 60
                ]
            ]
        ]);
    }
}