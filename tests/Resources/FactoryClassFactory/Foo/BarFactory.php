<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Resources\FactoryClassFactory\Foo;

use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Bar>
 */
final class BarFactory extends PersistentObjectFactory
{
    public static function class(): string
    {
        return Bar::class;
    }

    protected function defaults(): array|callable
    {
        return [];
    }
}
