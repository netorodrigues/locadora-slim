<?php

declare (strict_types = 1);
namespace App\Entities\Contracts;

interface Entity
{
    public function toArray(): array;
}
