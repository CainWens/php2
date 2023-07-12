<?php

namespace GeekBrains\LT\Blog;

use GeekBrains\LT\Person\Person;

class Post
{
    private int $id;
    private Person $author;
    private string $text;

    public function __construct(int $id, Person $author, string $text)
    {
        $this->id = $id;
        $this->author = $author;
        $this->text = $text;
    }

    public function __toString(): string
    {
        return $this->author . ' пишет: ' . $this->text . PHP_EOL;
    }
}