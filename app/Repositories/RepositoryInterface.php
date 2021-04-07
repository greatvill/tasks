<?php


namespace App\Repositories;


interface RepositoryInterface
{
    public function getModel();
    public function all();
    public function find(array $condition);
    public function findById($id);
    public function save(array $attribute);
    public function update($id, array $attribute);
}
