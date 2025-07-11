<?php

namespace Tests\Unit;

use App\Http\Controllers\ContactController;
use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Tests\Stubs\FakeContactRequest;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    private $repositoryMock;
    private ContactController $controller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repositoryMock = $this->createMock(ContactRepositoryInterface::class);
        $this->controller = new ContactController($this->repositoryMock);
    }

    public function testIndexReturnsContacts()
    {
        $request = new Request(['name' => 'John']);
        $contacts = collect([
            ['id' => 1, 'name' => 'John']
        ]);
        
        $this->repositoryMock
            ->expects($this->once())
            ->method('getContacts')
            ->with($request->all())
            ->willReturn($contacts);

        $response = $this->controller->index($request);
        
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertEquals(['success' => true, 'data' => $contacts->toArray()], $response->getData(true));
    }

    public function testStoreReturnsCreatedContact()
    {
        $data = [
			'name' => 'John',
			'phone' => '11912345678',
			'email' => 'john@example.com',
			'cep' => '12345678'
		];
		
        $request = new FakeContactRequest($data);

        $created = new Contact();
		$created->id = 1;
		$created->name = 'John';

        $this->repositoryMock
            ->expects($this->once())
            ->method('createContact')
            ->with($data)
            ->willReturn($created);

        $response = $this->controller->store($request);

        $this->assertEquals(201, $response->status());
        $this->assertEquals(['success' => true, 'data' => $created->toArray()], $response->getData(true));
    }

    public function testShowReturnsContact()
    {
        $contact = new Contact();
		$contact->id = 1;
		$contact->name = 'John';

        $this->repositoryMock
            ->expects($this->once())
            ->method('getContact')
            ->with(1)
            ->willReturn($contact);

        $response = $this->controller->show(1);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(['success' => true, 'data' => $contact->toArray()], $response->getData(true));
    }

    public function testShowReturnsNotFound()
    {
        $this->repositoryMock
            ->expects($this->once())
            ->method('getContact')
            ->with(999)
            ->willReturn(null);

        $response = $this->controller->show(999);

        $this->assertEquals(404, $response->status());
        $this->assertEquals([
            'success' => false,
            'message' => 'Contato não encontrado',
            'data' => null
        ], $response->getData(true));
    }

    public function testUpdateReturnsUpdatedContact()
    {
        $data = ['name' => 'Updated'];
        $request = new FakeContactRequest($data);

		$updated = new Contact();
		$updated->id = 1;
		$updated->name = 'Updated';

        $this->repositoryMock
            ->expects($this->once())
            ->method('updateContact')
            ->with('1', $data)
            ->willReturn($updated);

        $response = $this->controller->update($request, '1');

        $this->assertEquals(201, $response->status());
        $this->assertEquals(['success' => true, 'data' => $updated->toArray()], $response->getData(true));
    }

    public function testUpdateReturnsNotFound()
    {
        $data = ['name' => 'Updated'];
        $request = new FakeContactRequest($data);

        $this->repositoryMock
            ->expects($this->once())
            ->method('updateContact')
            ->with('999', $data)
            ->willReturn(null);

        $response = $this->controller->update($request, '999');

        $this->assertEquals(404, $response->status());
        $this->assertEquals([
            'success' => false,
            'message' => 'Contato não encontrado',
            'data' => null
        ], $response->getData(true));
    }

    public function testDestroyReturnsSuccess()
    {
        $this->repositoryMock
            ->expects($this->once())
            ->method('deleteContact')
            ->with(1)
            ->willReturn(true);

        $response = $this->controller->destroy(1);

        $this->assertEquals(204, $response->status());
        $this->assertEquals(['success' => true, 'data' => null], $response->getData(true));
    }

    public function testDestroyReturnsNotFound()
    {
        $this->repositoryMock
            ->expects($this->once())
            ->method('deleteContact')
            ->with(999)
            ->willReturn(false);

        $response = $this->controller->destroy(999);

        $this->assertEquals(404, $response->status());
        $this->assertEquals([
            'success' => false,
            'message' => 'Contato não encontrado',
            'data' => null
        ], $response->getData(true));
    }
}