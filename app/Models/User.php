<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    const ROLE_SPECIALIST = 'spec';
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return MorphMany
     */
    public function tasksCreated(): MorphMany
    {
        return $this->morphMany(Task::class, 'creator');
    }

    /**
     * @return HasMany
     */
    public function tasksExecuting(): HasMany
    {
        return $this->hasMany(Task::class, 'id', 'executor_id');
    }

    /**
     * Get roles for users
     * @return string[]
     */
    public static function roles(): array
    {
        return [self::ROLE_ADMIN, self::ROLE_MANAGER, self::ROLE_SPECIALIST];
    }

}
