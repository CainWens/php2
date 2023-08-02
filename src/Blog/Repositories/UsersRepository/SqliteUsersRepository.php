<?php

namespace GeekBrains\LT\Blog\Repositories\UsersRepository;

use GeekBrains\LT\Blog\User;
use GeekBrains\LT\Blog\UUID;
use GeekBrains\LT\Blog\Exeptions\UserNotFoundExeption;
use GeekBrains\LT\Person\Name;
use GeekBrains\LT\Blog\Repositories\UsersRepository\UserRepositoryInterface;
use \PDO;
use \PDOStatement;

class SqliteUsersRepository implements UserRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO users 
            (first_name, last_name, uuid, login) 
            VALUES 
            (:first_name,:last_name,:uuid,:login)'
        );
        $statement->execute([
            ':first_name' => $user->name()->first(),
            ':last_name' => $user->name()->last(),
            ':uuid' => $user->uuid(),
            ':login' => $user->login()
        ]);
    }

    public function get(UUID $uuid): User
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE uuid = :uuid'
        );
        $statement->execute([
            ':uuid' => $uuid
        ]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        // Бросаем исключение, если пользователь не найден
        if ($result === false) {
            throw new UserNotFoundExeption(
                "Cannot get user: $uuid"
            );
        }
        return $this->getUser($statement, $uuid);
    }

    public function login(string $login): User
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE login = :login'
        );
        $statement->execute([
            ':login' => $login
        ]);
        return $this->getUser($statement, $login);
    }

    public function getUser(PDOStatement $statement, string $login): User
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            throw new UserNotFoundExeption(
                "Not find user: $login"
            );
        }

        return new User(
            new UUID($result['uuid']),
            new Name($result['first_name'], $result['last_name']),
            $result['login']
        );
    }

}