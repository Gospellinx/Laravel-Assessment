<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_product()
    {
        $user = User::factory()->create();
        $token = $user->createToken('api-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->postJson('/api/products', [
            'name'  => 'Test Product',
            'price' => 99.99,
            'stock' => 10,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'name'  => 'Test Product',
                     'price' => 99.99,
                     'stock' => 10,
                 ]);
    }
}

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
