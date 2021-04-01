<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'second_name',
        'patronymic',
    ];

    /**
     * @return HasMany
     */
    public function card(): HasMany
    {
        return $this->hasMany(Card::class);
    }
}
