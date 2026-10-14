<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Resources\FactoryClassFactory;

use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<FooBar>
 */
final class FooBarFactory extends PersistentObjectFactory
{
    public static function class(): string
    {
        return FooBar::class;
    }

    protected function defaults(): array|callable
    {
        return [];
    }
}
