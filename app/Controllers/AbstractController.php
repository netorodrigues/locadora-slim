<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface as Container;

abstract class AbstractController
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}
