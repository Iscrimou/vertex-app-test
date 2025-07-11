<?php

namespace App\Repositories;

use App\Interfaces\AddressRepositoryInterface;
use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;
use App\Services\CepService;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ContactRepository implements ContactRepositoryInterface
{
    protected CepService $cepService;
    protected AddressRepositoryInterface $addressRepository;

    public function __construct(CepService $cepService, AddressRepositoryInterface $addressRepository)
    {
        $this->cepService = $cepService;
        $this->addressRepository = $addressRepository;
    }
    
    public function getContacts(array $filters): Collection
    {
        $contacts = Contact::getQuery();

        if (!empty($filters)) {
            $contacts = self::filter($contacts, $filters);
        }

        $contacts = $contacts->get();

        return $contacts;
    }

    public function getContact(int $id): Contact | null
    {
        return Contact::find($id);

    }

    public function createContact(array $data): Contact | null
    {
        $validCep = $this->cepService->checkCep($data['cep']);

        if (empty($validCep)) {
            return null;
        }

        $addressData = Arr::only($validCep, [
            'cep',
            'logradouro',
            'complemento',
            'unidade',
            'bairro',
            'localidade',
            'uf',
            'estado'
        ]);

        $this->addressRepository->create($addressData);
        
        return Contact::create($data);
    }

    public function updateContact(int $id, array $data): Contact | null
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return null;
        }

        $contact->update($data);

        return $contact->refresh();
    }

    public function deleteContact(int $id): bool
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return false;
        }

        $contact->forceDelete();

        return true;
    }

    public static function filter($query, array $filters): Builder
    {
        $filtredContacts = $query->where(function ($query) use ($filters) {
            if (isset($filters['search'])) {
                $query->where('name', 'LIKE', "%{$filters['search']}%")
                    ->orWhere('email', 'LIKE', '%'.$filters['search'].'%');
            }
        });

        return $filtredContacts;
    }
}