<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Resources\FactoryClassFactory;

use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Foo>
 */
final class FooFactory extends PersistentObjectFactory
{
    public static function class(): string
    {
        return Foo::class;
    }

    protected function defaults(): array|callable
    {
        return [];
    }
}
