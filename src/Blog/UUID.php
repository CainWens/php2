<?php

namespace GeekBrains\LT\Blog;

use GeekBrains\LT\Blog\Exeptions\InvalidArgumentExeption;
use InvalidArgumentException;

class UUID
{
    public function __construct(
        private string $uuidString
    ) {
        // Если входная строка не подходит по формату -
        // бросаем исключение InvalidArgumentException
        //
        // Таким образом, мы гарантируем, что если объект
        // был создан, то он точно содержит правильный UUID
        if (!uuid_is_valid($uuidString)) {
            throw new InvalidArgumentException(
                "Malformed UUID: $this->uuidString"
            );
        }
    }
    // А так мы можем сгенерировать новый случайный UUID
    // и получить его в качестве объекта нашего класса
    public static function random(): self
    {
        return new self(uuid_create(UUID_TYPE_RANDOM));
    }
    public function __toString(): string
    {
        return $this->uuidString;
    }

    
}