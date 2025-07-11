<?php

namespace App\Interfaces;

use App\Models\Address;
use Illuminate\Support\Collection;

interface AddressRepositoryInterface
{
    public function getAll(): Collection;
    public function create(array $data): Address;
}
