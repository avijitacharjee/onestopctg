<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SaleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_sale_list()
    {
        $response = $this->get('/sale');

        $response->assertStatus(302);

        $response = $this->actingAs(User::first())->get('/sale');
        $response->assertStatus(200);
        $response->assertSee('Action');
    }
}
