<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\Compiler;

use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\DateTime\ArgumentGuesserInterface;

/**
 * @phpstan-import-type IntlFormats from ArgumentGuesserInterface
 */
final class EnumCompiler
{
    public function __invoke(string $enum, string $property = null): string
    {
        return '';
    }
}
