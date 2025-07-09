<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();

        return response()->json($contacts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        $validated = $request->validated();

        $contact = Contact::create($validated);

        return response()->json($contact);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(["message" => "Contato não encontrado"], 400);
        }
        
        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, string $id)
    {
        $validated = $request->validated();
        $contact = Contact::find($id);
        
        if (!$contact) {
            return response()->json(["message" => "Contato não encontrado"], 400);
        }
        
        $contact = $contact->update($validated);

        return response()->json($contact);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::find($id);
        
        if (!$contact) {
            return response()->json(["message" => "Contato não encontrado"], 400);
        }

        $contact->forceDelete();

        return response()->json(["message" => "Contato apagado com sucesso"]);
    }
}
