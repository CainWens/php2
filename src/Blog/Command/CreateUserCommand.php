<?php

namespace GeekBrains\LT\Blog\Command;

use GeekBrains\LT\Blog\Exeptions\CommandException;
use GeekBrains\LT\Blog\Repositories\UsersRepository\UserRepositoryInterface;
use GeekBrains\LT\Blog\Exeptions\InvalidArgumentExeption;
use GeekBrains\LT\Blog\Exeptions\UserNotFoundExeption;
use GeekBrains\LT\Blog\User;
use GeekBrains\LT\Blog\Repositories\UsersRepository\InMemoryUserRepository;
use GeekBrains\LT\Person\Name;
use GeekBrains\LT\Blog\UUID;

class CreateUserCommand
{
    public function __construct(
        private UserRepositoryInterface $usersRepository
    ) {

    }

    public function handle(array $rawInput): void
    {
        $input = $this->parseRawInput($rawInput);
        $login = $input['login'];
        // Проверяем, существует ли пользователь в репозитории
        if ($this->userExists($login)) {
            // Бросаем исключение, если пользователь уже существует
            throw new CommandException("User already exists: $login");
        }
        // Сохраняем пользователя в репозиторий
        $this->usersRepository->save(
            new User(
                UUID::random(),
                new Name($input['first_name'], $input['last_name']),
                $input['login']
            )
        );
    }

    private function parseRawInput(array $rawInput): array
    {
        $input = [];
        foreach ($rawInput as $argument) {
            $parts = explode('=', $argument);
            if (count($parts) !== 2) {
                continue;
            }
            $input[$parts[0]] = $parts[1];
        }
        foreach (['login', 'first_name', 'last_name'] as $argument) {
            if (!array_key_exists($argument, $input)) {
                throw new CommandException(
                    "No required argument provided: $argument"
                );
            }
            if (empty($input[$argument])) {
                throw new CommandException(
                    "Empty argument provided: $argument"
                );
            }
        }
        return $input;
    }
    private function userExists(string $login): bool
    {
        try {
            // Пытаемся получить пользователя из репозитория
            $this->usersRepository->login($login);
        } catch (UserNotFoundException) {
            return false;
        }
        return true;
    }

}