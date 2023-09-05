<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Unit\ExpressionLanguage\ArgumentGuesser\Factory;

use PHPUnit\Framework\TestCase;
use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory\ArgumentGuesserInterface;
use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory\MinArgumentGuesser;

/**
 * @phpstan-import-type FactoryAttributes from ArgumentGuesserInterface
 */
final class MinArgumentGuesserTest extends TestCase
{
    /**
     * @dataProvider arguments
     *
     * @param FactoryAttributes|string|null $method
     * @param FactoryAttributes|string|null $min
     * @param FactoryAttributes|string|null $attributes
     */
    public function testInvokingTheGuesser(
        int|null $expected,
        array|string|null $method,
        array|string|null $min,
        array|string|null $attributes,
        string|null $accessor,
    ): void {
        $guess = new MinArgumentGuesser();

        self::assertSame($expected, $guess($method, $min, $attributes, $accessor));
    }

    /**
     * @return iterable<string, array{
     *     int|null,
     *     FactoryAttributes|string|null,
     *     FactoryAttributes|string|null,
     *     FactoryAttributes|string|null,
     *     string|null,
     * }>
     */
    public function arguments(): iterable
    {
        yield 'all arguments set not null should return null' => [null, null, null, null, null];
        yield 'a non null method and a numeric value as 2nd argument should return the 2nd argument as int' => [
            2,
            'find',
            '2',
            null,
            null,
        ];
    }
}
