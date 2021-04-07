<?php


namespace App\Services;


use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function save(array $attributes)
    {
        $attributes = self::dataHanding($attributes);
        return $this->userRepository->save($attributes);
    }

    public function update($id, array $attributes = [])
    {
        $attributes = self::dataHanding($attributes);
        return $this->userRepository->update($id, $attributes);
    }

    private static function checkRole(string $role)
    {
        if (is_null($role) || ! in_array($role, User::roles())) {
            throw new \InvalidArgumentException(__('user_service.role_not_exists', ['role' => $role]));
        }
    }
    private static function hashPassword(string $password)
    {
        return Hash::make($password);
    }
    private static function dataHanding(array $attributes)
    {
        $role = $attributes['role'] ?? null;
        self::checkRole($role);

        if (empty($attributes['password'])) {
            throw new \InvalidArgumentException(__('user_service.empty_password'));
        }
        $attributes['password'] = self::hashPassword($attributes['password']);
        return $attributes;
    }
}
