<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Support\Collection;

class UserEloquentRepository implements UserRepositoryInterface
{
    public function findByStringSearch(string $stringSearch): \Illuminate\Support\Collection
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

    public function findByRole(string $role): Collection
    {
        return Client::where('role', 'like', $stringSearch)
            ->get();
    }
}
