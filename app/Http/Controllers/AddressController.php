<?php

namespace App\Http\Controllers;

use App\Interfaces\AddressRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository) 
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $addresses = $this->addressRepository->getAll();

        return $this->success($addresses);
    }
}
