<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class ClientEloquentRepository extends AbstractEloquentRepository implements ClientRepositoryInterface
{
    use Searchable;

    public function searchableAttributes(): array
    {
        return ['first_name', 'middle_name', 'last_name'];
    }

    public function getModel(): Model
    {
        return new Client();
    }
}
