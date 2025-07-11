<?php

namespace App\Interfaces;

use App\Models\Contact;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

interface ContactRepositoryInterface
{
    public function getContacts(array $filters): Collection;
    public function getContact(int $id): Contact | null;
    public function createContact(array $data): Contact | null;
    public function updateContact(int $id, array $data): Contact | null;
    public function deleteContact(int $id): bool;
    public static function filter($query, array $filters): Builder;

}