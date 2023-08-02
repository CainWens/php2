<?php

namespace GeekBrains\LT\Blog\Repositories\UsersRepository;

use GeekBrains\LT\Blog\User;
use GeekBrains\LT\Blog\Exeptions\UserNotFoundExeption;
use GeekBrains\LT\Blog\UUID;

class InMemoryUserRepository implements UserRepositoryInterface
{
    private array $users = [];

    public function save(User $user)
    {
        $this->users[] = $user;

    }

    public function get(UUID $uuid): User
    {
        foreach ($this->users as $user) {
            if ($user->uuid() === $uuid) {
                return $user;
            }
        }
        throw new UserNotFoundExeption("User not found: $uuid");
    }
    /**
     * @param string $login
     * @return User
     */
    public function login(string $login): User
    {
    }
}