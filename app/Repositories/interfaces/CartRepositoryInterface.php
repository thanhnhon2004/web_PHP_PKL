<?php

namespace App\Repositories\Interfaces;

interface CartRepositoryInterface
{
    public function getByUser(int $userId);
}
