<?php

namespace App\Repositories;

interface ClientRepositoryInterface extends RepositoryInterface
{
    public function findByStringSearch(string $stringSearch): \Illuminate\Support\Collection;
}
