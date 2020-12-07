<?php

declare (strict_types = 1);

use App\Factories\Contracts\ItemFactoryInterface;
use App\Factories\MongoItemFactory;
use function DI\create as useInstance;

$dependencies = [
    ItemFactoryInterface::class => useInstance(MongoItemFactory::class),
];

return $dependencies;
