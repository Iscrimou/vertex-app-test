<?php

namespace Tests\Unit;

use App\Http\Controllers\AddressController;
use App\Interfaces\AddressRepositoryInterface;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    private $repositoryMock;
    private AddressController $controller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repositoryMock = $this->createMock(AddressRepositoryInterface::class);
        $this->controller = new AddressController($this->repositoryMock);
    }

    public function testIndexReturnsAddresses()
    {
        $addresses = collect([
            new Address([
                'cep' => '12345678',
                'logradouro' => 'Rua Exemplo',
                'bairro' => 'Centro',
                'localidade' => 'Cidade',
                'uf' => 'SP',
                'estado' => 'SP'
            ])
        ]);

        $this->repositoryMock
            ->expects($this->once())
            ->method('getAll')
            ->willReturn($addresses);

        $response = $this->controller->index(new Request());

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals([
            'success' => true,
            'data' => $addresses->toArray()
        ], $response->getData(true));
    }
}
