<?php

namespace GeekBrains\LT\Person;

use GeekBrains\LT\Person\Name;
use \DateTimeImmutable;

class Person
{
    private Name $name;
    private DateTimeImmutable $registeredOn;

    public function __construct(Name $name, DateTimeImmutable $registeredOn)
    {
        $this->registeredOn = $registeredOn;
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name . ' (на сайте с ' . $this->registeredOn->format('d-m-Y') . ')';
    }
}