<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\Compiler;

use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\DateTime\ArgumentGuesserInterface;

/**
 * @phpstan-import-type IntlFormats from ArgumentGuesserInterface
 */
final class DateTimeCompiler
{
    /**
     * @param IntlFormats|string|null $time
     * @param IntlFormats|string|null $format
     */
    public function __invoke(string|array|null $time = null, string|array|null $format = null): string
    {
        return '';
    }
}
