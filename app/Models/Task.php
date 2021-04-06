<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'card_id',
        'creator_id',
        'creator_type',
        'executor_id'
    ];

    /**
     * @return BelongsTo
     */
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * @return MorphTo
     */
    public function creator(): MorphTo
    {
        return $this->morphTo('creator');
    }

    /**
     * @return BelongsTo
     */
    public function executor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



}
