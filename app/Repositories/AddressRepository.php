<?php
namespace App\Repositories;

use App\Interfaces\AddressRepositoryInterface;
use App\Models\Address;
use Illuminate\Support\Collection;

class AddressRepository implements AddressRepositoryInterface
{
    public function getAll(): Collection
    {
        return Address::all();
    }
    
    public function create(array $data): Address
    {
        return Address::create($data);
    }
}