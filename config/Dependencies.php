<?php

declare (strict_types = 1);

use App\Factories\ItemFactory;
use App\Factories\ItemFactoryInterface;
use function DI\create as useInstance;

$dependencies = [
    ItemFactoryInterface::class => useInstance(ItemFactory::class),
];

return $dependencies;
