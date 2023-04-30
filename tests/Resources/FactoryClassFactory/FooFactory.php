<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Resources\FactoryClassFactory;

use Zenstruck\Foundry\ModelFactory;

/**
 * @extends ModelFactory<Foo>
 */
final class FooFactory extends ModelFactory
{
    protected static function getClass(): string
    {
        return Foo::class;
    }

    /**
     * @return array<mixed>
     */
    protected function getDefaults(): array
    {
        return [];
    }
}
