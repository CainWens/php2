<?php

namespace GeekBrains\LT\Blog;

use GeekBrains\LT\Person\Name;

class User
{
    private UUID $uuid;
    private Name $username;
    private string $login;

    /**
     * @param UUID $uuid - id ползователя
     * @param Name $username имя 
     * @param string $login логин
     */
    public function __construct(UUID $uuid, Name $username, string $login)
    {
        $this->uuid = $uuid;
        $this->username = $username;
        $this->login = $login;
    }

    public function __toString(): string
    {
        return "Юзер $this->uuid с именем $this->username и логином $this->login." . PHP_EOL;
    }




    /**
     * Get the value of id
     */
    public function uuid(): UUID
    {
        return $this->uuid;
    }

    public function name(): Name
    {
        return $this->username;
    }

    public function login(): string
    {
        return $this->login;
    }
}