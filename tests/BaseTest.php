<?php

declare (strict_types = 1);

namespace Tests;

use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{

    protected $container;
    public function setUp(): void
    {
        global $app;
        $this->container = $app->getContainer();
    }
}
