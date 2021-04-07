<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\User;
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
        return User::all();
    }

    public function find(array $condition)
    {
       //
    }

    public function findById($id)
    {
        return User::find($id);
    }

    public function findByRole(string $role): Collection
    {
        return User::where('role', 'like', $stringSearch)
            ->get();
    }

    public function save($attributes)
    {
        return User::create($attributes);
    }
    public function update($id, $attributes)
    {
        $user = User::findOrFail($id);
        $user->fill($attributes);
        if (! $user->save()) {
            throw new \Exception('User is not saved');
        }
        return $user;
    }
}
