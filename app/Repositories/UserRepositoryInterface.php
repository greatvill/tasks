<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function search(string $textSearch): ?Collection;
    public function findByRole(string $role): ?Collection;
}
