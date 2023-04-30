<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Resources\FactoryClassFactory;

use Zenstruck\Foundry\ModelFactory;

/**
 * @extends ModelFactory<FooBar>
 */
final class FooBarFactory extends ModelFactory
{
    protected static function getClass(): string
    {
        return FooBar::class;
    }

    /**
     * @return array<mixed>
     */
    protected function getDefaults(): array
    {
        return [];
    }
}
