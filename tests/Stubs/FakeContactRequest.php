<?php

namespace Tests\Stubs;

use App\Http\Requests\ContactRequest;

class FakeContactRequest extends ContactRequest
{
    protected array $fakeData = [];

    public function __construct(array $fakeData = [])
    {
        parent::__construct([], [], [], [], [], []);
        $this->fakeData = $fakeData ?: [
            'name' => 'John',
            'phone' => '11912345678',
            'email' => 'john@example.com',
            'cep' => '12345678',
        ];
    }

    public function validated($key = null, $default = null)
    {
        if ($key !== null) {
            return $this->fakeData[$key] ?? $default;
        }

        return $this->fakeData;
    }
}