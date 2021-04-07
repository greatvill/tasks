<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserEloquentRepository extends AbstractEloquentRepository implements UserRepositoryInterface
{
    use Searchable;

    public function searchableAttributes(): array
    {
        return ['first_name', 'middle_name', 'last_name'];
    }

    public function getModel(): Model
    {
        return new User();
    }

    public function all()
    {
        return $this->getModel()::all();
    }

    public function findById($id)
    {
        return $this->getModel()::find($id);
    }

    public function findByRole(string $role): Collection
    {
        return $this->getModel()::where('role', 'like', $role)
            ->get();
    }
}
