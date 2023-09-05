<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Unit\ExpressionLanguage\ArgumentGuesser\Factory;

use PHPUnit\Framework\TestCase;
use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory\ArgumentGuesserInterface;
use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory\AttributesArgumentGuesser;

/**
 * @phpstan-import-type FactoryAttributes from ArgumentGuesserInterface
 */
final class AttributesArgumentGuesserTest extends TestCase
{
    /**
     * @dataProvider arguments
     *
     * @param FactoryAttributes|string|null $expected
     * @param FactoryAttributes|string|null $method
     * @param FactoryAttributes|string|null $min
     * @param FactoryAttributes|string|null $attributes
     */
    public function testInvokingTheGuesser(
        array|string|null $expected,
        array|string|null $method,
        array|string|null $min,
        array|string|null $attributes,
        string|null $accessor,
    ): void {
        $guess = new AttributesArgumentGuesser();

        self::assertSame($expected, $guess($method, $min, $attributes, $accessor));
    }

    /**
     * @return iterable<string, array{
     *     FactoryAttributes|string|null,
     *     FactoryAttributes|string|null,
     *     FactoryAttributes|string|null,
     *     FactoryAttributes|string|null,
     *     string|null,
     * }>
     */
    public function arguments(): iterable
    {
        yield 'all arguments set not null should return null' => [null, null, null, null, null];
        yield 'an array as 1st argument should return the 1st argument' => [[], [], null, null, null];
        yield 'a non null method and an array as 2nd argument should return the 2nd argument' => [
            [],
            'find',
            [],
            null,
            null,
        ];
        yield 'a non null method, a numeric value as 2nd argument and an array as 3rd argument'
            . ' should return the 3rd argument' => [
            [],
            'randomSet',
            '2',
            [],
            null,
        ];
    }
}
