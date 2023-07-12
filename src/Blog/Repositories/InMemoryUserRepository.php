<?php

namespace GeekBrains\LT\Blog\Repositories;

use GeekBrains\LT\Blog\User;
use GeekBrains\LT\Blog\Exeptions\UserNotFoundExeption;

class InMemoryUserRepository
{
    private array $users = [];

    public function save(User $user)
    {
        $this->users[] = $user;

    }

    public function get(int $id): User
    {
        foreach ($this->users as $user) {
            if ($user->getId() === $id) {
                return $user;
            }
        }
        throw new UserNotFoundExeption("User not found: $id");
    }
}