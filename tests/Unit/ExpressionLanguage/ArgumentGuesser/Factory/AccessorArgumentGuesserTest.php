<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Unit\ExpressionLanguage\ArgumentGuesser\Factory;

use PHPUnit\Framework\TestCase;
use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory\AccessorArgumentGuesser;
use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory\ArgumentGuesserInterface;

/**
 * @phpstan-import-type FactoryAttributes from ArgumentGuesserInterface
 */
final class AccessorArgumentGuesserTest extends TestCase
{
    /**
     * @dataProvider arguments
     *
     * @param FactoryAttributes|string|null $expected
     * @param FactoryAttributes|string|null $method
     * @param FactoryAttributes|string|null $attributes
     */
    public function testInvokingTheGuesser(
        array|string|null $expected,
        array|string|null $method,
        array|string|null $attributes,
        string|null $accessor,
    ): void {
        $guess = new AccessorArgumentGuesser();

        self::assertSame($expected, $guess($method, $attributes, $accessor));
    }

    /**
     * @return iterable<string, array{
     *     FactoryAttributes|string|null,
     *     FactoryAttributes|string|null,
     *     FactoryAttributes|string|null,
     *     string|null,
     * }>
     */
    public function arguments(): iterable
    {
        yield 'all arguments set not null should return null' => [null, null, null, null];
        yield 'a non null method and a string as 2nd argument should return the 2nd argument' => [
            'firstname',
            'find',
            'firstname',
            null,
        ];
        yield 'a non null method, an array of attributes and a string as 3rd argument'
            . ' should return the 3rd argument' => [
            'lastname',
            'find',
            [],
            'lastname',
        ];
    }
}
