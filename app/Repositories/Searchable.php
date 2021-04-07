<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

trait Searchable
{
    abstract public function searchableAttributes(): array;
    abstract public function getModel(): Model;

    public function search(string $textSearch): ?\Illuminate\Support\Collection
    {
        $textSearch = '%' . $textSearch . '%';
        $attributes = $this->searchableAttributes();
        if (empty($attributes)) {
            return null;
        }
        $query = $this->getModel();
        foreach ($attributes as $attr)
        {
            $query = $query->orWhere($attr, 'like', $textSearch);
        }
        return $query->get();
    }
}
