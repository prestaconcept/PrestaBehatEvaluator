<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Resources\FactoryClassFactory\Foo;

use Zenstruck\Foundry\ModelFactory;

/**
 * @extends ModelFactory<Bar>
 */
final class BarFactory extends ModelFactory
{
    protected static function getClass(): string
    {
        return Bar::class;
    }

    /**
     * @return array<mixed>
     */
    protected function getDefaults(): array
    {
        return [];
    }
}
