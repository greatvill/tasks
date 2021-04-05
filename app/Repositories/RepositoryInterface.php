<?php


namespace App\Repositories;


interface RepositoryInterface
{
    public function all();
    public function find(array $condition);
    public function findById($id);
}
