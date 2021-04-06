<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findByStringSearch(string $stringSearch): Collection;
    public function findByRole(string $role): Collection;
}
