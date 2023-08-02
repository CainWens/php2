<?php

namespace GeekBrains\LT\Blog\Repositories\UsersRepository;

use GeekBrains\LT\Blog\User;
use GeekBrains\LT\Blog\UUID;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function get(UUID $uuid): User;
    public function login(string $login):User;
}