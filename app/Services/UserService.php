<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function save(array $attributes)
    {
        self::dataHanding($attributes);
        return User::create($attributes);
    }

    public static function update(User $user, array $attributes = [])
    {
        self::dataHanding($attributes);
        $user->fill($attributes);
        if (!$user->save()) {
            throw new \Exception('User is not saved');
        }
        return $user;
    }

    private static function checkRole(string $role)
    {
        if (is_null($role) || ! in_array($role, User::roles())) {
            throw new \InvalidArgumentException("Role '$role' is not exists");
        }
    }
    private static function hashPassword(string &$password)
    {
        if (! $password) {
            throw new \InvalidArgumentException("Password is empty");
        }
        $password = Hash::make($password);
    }
    private static function dataHanding(array &$attributes)
    {
        $role = $attributes['role'] ?? null;
        self::checkRole($role);
        self::hashPassword($attributes['password']);
    }
}
