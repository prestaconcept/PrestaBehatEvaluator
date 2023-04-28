<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Resources;

use Presta\BehatEvaluator\ExpressionLanguage\ExpressionLanguage;

final class ExpressionLanguageFactory
{
    public static function create(string $culture = 'fr_FR'): ExpressionLanguage
    {
        return new ExpressionLanguage($culture);
    }
}
