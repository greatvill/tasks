<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'id_card'];

    /**
     * @return BelongsTo
     */
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}
