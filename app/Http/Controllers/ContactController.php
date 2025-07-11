<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Interfaces\ContactRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private ContactRepositoryInterface $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository) 
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $filters = $request->all();
        $contacts = $this->contactRepository->getContacts($filters);

        return $this->success($contacts);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $contact = $this->contactRepository->createContact($validated);
        
        if (!$contact) {
            return $this->error("CEP inválido", null, 400);
        }

        return $this->success($contact, 201);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $contact = $this->contactRepository->getContact($id);
        
        if (!$contact) {
            return $this->error("Contato não encontrado", null, 404);
        }
        
        return $this->success($contact, 200);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $contact = $this->contactRepository->updateContact($id, $validated);
        
        if (!$contact) {
            return $this->error("Contato não encontrado", null, 404);
        }
        
        return $this->success($contact, 201);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $contact = $this->contactRepository->deleteContact($id);
        
        if (!$contact) {
            return $this->error("Contato não encontrado", null, 404);
        }
        
        return $this->success(null, 204);
    }
}
