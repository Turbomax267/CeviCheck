<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function paginate(int $perPage = 15)
    {
        return $this->userRepository->paginate($perPage);
    }

    public function store(array $data): User
    {
        return $this->userRepository->create($data);
    }

    public function update(User $user, array $data): User
    {
        return $this->userRepository->update($user, $data);
    }

    public function destroy(User $user): void
    {
        $this->userRepository->delete($user);
    }
}

