<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Unit\Adapter;

use PHPUnit\Framework\TestCase;
use Presta\BehatEvaluator\Adapter\EnumAdapter;
use Presta\BehatEvaluator\Tests\Resources\ExpressionLanguageFactory;
use Presta\BehatEvaluator\Tests\Resources\PriorityEnum;
use Presta\BehatEvaluator\Tests\Resources\StatusEnum;
use Presta\BehatEvaluator\Tests\Resources\UnsupportedValuesProvider;
use Symfony\Component\ExpressionLanguage\SyntaxError;

final class EnumAdapterTest extends TestCase
{
    use UnsupportedValuesProvider;

    /**
     * @dataProvider values
     */
    public function testInvokingTheAdapter(mixed $expected, mixed $value): void
    {
        if ($expected instanceof \Throwable) {
            $this->expectException(get_class($expected));

            if ('' !== $expected->getMessage()) {
                $this->expectExceptionMessage($expected->getMessage());
            }
        }

        $evaluate = new EnumAdapter(ExpressionLanguageFactory::create());
        $value = $evaluate($value);

        if ($expected instanceof \Throwable) {
            return;
        }

        self::assertSame($expected, $value);
    }

    /**
     * @return iterable<string, array{mixed, mixed}>
     */
    public function values(): iterable
    {
        yield 'a string containing only an int backed enum case should return the case\'s value' => [
            PriorityEnum::High->value,
            '<enum("Presta\\\\BehatEvaluator\\\\Tests\\\\Resources\\\\PriorityEnum::High")>',
        ];
        yield 'a string containing only a string backed enum case should return the case\'s value' => [
            StatusEnum::Todo->value,
            '<enum("Presta\\\\BehatEvaluator\\\\Tests\\\\Resources\\\\StatusEnum::Todo")>',
        ];
        yield 'a string containing only a non existing enum should return the original expression unchanged' => [
            '<enum("Undefined")>',
            '<enum("Undefined")>',
        ];
        yield 'a string containing only a non existing enum class should return the original expression unchanged' => [
            '<enum("Invalid\\\\Path::Undefined")>',
            '<enum("Invalid\\\\Path::Undefined")>',
        ];
        yield 'a string containing only a non existing enum case should return the original expression unchanged' => [
            '<enum("Presta\\\\BehatEvaluator\\\\Tests\\\\Resources\\\\FooBarEnum::Undefined")>',
            '<enum("Presta\\\\BehatEvaluator\\\\Tests\\\\Resources\\\\FooBarEnum::Undefined")>',
        ];
        yield 'a string containing only a valid enum case but without the enum function'
            . ' should return the original expression unchanged' => [
            'Presta\\\\BehatEvaluator\\\\Tests\\\\Resources\\\\FooBarEnum::Foo',
            'Presta\\\\BehatEvaluator\\\\Tests\\\\Resources\\\\FooBarEnum::Foo',
        ];
        yield 'a string containing an int backed enum expression'
            . ' should return the string after evaluating the enum expression' => [
            'the value ' . PriorityEnum::Default->value . ' comes from a constant',
            'the value <enum("Presta\\\\BehatEvaluator\\\\Tests\\\\Resources\\\\PriorityEnum::Default")>'
                . ' comes from a constant',
        ];
        yield 'a string containing a string backed enum expression'
            . ' should return the string after evaluating the enum expression' => [
            'the value ' . StatusEnum::Doing->value . ' comes from a constant',
            'the value <enum("Presta\\\\BehatEvaluator\\\\Tests\\\\Resources\\\\StatusEnum::Doing")>'
                . ' comes from a constant',
        ];
        yield 'a string containing many constant expressions'
            . ' should return the string after evaluating the constant expressions' => [
            'the values ' . PriorityEnum::Low->value . ' and ' . StatusEnum::Done->value . ' come from enums',
            'the values <enum("Presta\\\\BehatEvaluator\\\\Tests\\\\Resources\\\\PriorityEnum::Low")>'
                . ' and <enum("Presta\\\\BehatEvaluator\\\\Tests\\\\Resources\\\\StatusEnum::Done")>'
                . ' come from enums',
        ];
        yield from self::unsupportedValues(['string']);
        yield 'a string containing a malformed argument should throw a syntax error' => [
            new SyntaxError('Variable "this" is not valid', 6, 'enum(this is a malformed argument)'),
            '<enum(this is a malformed argument)>',
        ];
        yield 'a string containing an expression returning a non backed enum, should throw a runtime exception' => [
            new \RuntimeException(),
            'the value <enum("Presta\\\\BehatEvaluator\\\\Tests\\\\Resources\\\\FooBarEnum::Foo")>'
            . ' is not a backed enum',
        ];
    }
}
