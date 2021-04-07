<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface ClientRepositoryInterface extends RepositoryInterface
{
    public function search(string $textSearch): ?Collection;
}
