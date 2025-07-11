<?php

namespace Tests\Feature;

use App\Services\CepService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateContactWithCepValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_contact_with_invalid_cep_should_return_empty()
    {
        $mockCepService = $this->createMock(CepService::class);
        $mockCepService->expects($this->once())->method('checkCep')->with('00000000')->willReturn([]);
        $this->app->instance(CepService::class, $mockCepService);

        $data = [
            'name' => 'João',
            'phone' => '11912345678',
            'email' => 'joao@example.com',
            'cep' => '00000000',
        ];

        $response = $this->postJson('/api/contacts', $data);

        $response->assertStatus(400); 
        $response->assertJson([
            'success' => false,
            'message' => 'CEP inválido',
        ]);

        $this->assertDatabaseCount('contacts', 0);
    }
}
