<?php

namespace App\Repositories;

use App\Models\Client;

class ClientEloquentRepository implements ClientRepositoryInterface
{
    public function findByStringSearch(string $stringSearch)
    {
        $stringSearch = '%' . $stringSearch . '%';
        return Client::where('first_name', 'like', $stringSearch)
            ->orWhere('middle_name', 'like', $stringSearch)
            ->orWhere('last_name', 'like', $stringSearch)
            ->get();
    }

    public function all()
    {
        return Client::all();
    }

    public function find(array $condition)
    {
       //
    }

    public function findById($id)
    {
        return Client::find($id);
    }
}
