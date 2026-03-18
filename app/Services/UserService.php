<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(array $data)
    {
        return $this->userRepo->create($data);
    }

    public function updateProfile($id, array $data)
    {
        return $this->userRepo->update($id, $data);
    }

    public function getUserByEmail($email)
    {
        return $this->userRepo->findByEmail($email);
    }
}
