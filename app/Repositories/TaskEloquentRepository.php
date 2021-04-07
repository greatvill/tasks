<?php


namespace App\Repositories;


use App\Models\Task;
use Illuminate\Database\Eloquent\Model;

class TaskEloquentRepository extends AbstractEloquentRepository implements TaskRepositoryInterface
{
    public function getModel(): Model
    {
        return new Task();
    }
}
