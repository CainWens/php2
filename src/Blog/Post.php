<?php

namespace GeekBrains\LT\Blog;

use GeekBrains\LT\Blog\User;

class Post
{
    private int $id;
    private User $user;
    private string $text;

    public function __construct(int $id, User $user, string $text)
    {
        $this->id = $id;
        $this->user = $user;
        $this->text = $text;
    }

    public function __toString(): string
    {
        return $this->user . ' пишет: ' . $this->text . PHP_EOL;
    }
}