<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Resources;

use Presta\BehatEvaluator\ExpressionLanguage\ExpressionLanguage;
use Presta\BehatEvaluator\Foundry\FactoryClassFactory;

final class ExpressionLanguageFactory
{
    public static function create(
        string $namespace = 'Presta\\BehatEvaluator\\Tests\\Application\\Foundry\\Factory\\',
        string $culture = 'fr_FR',
    ): ExpressionLanguage {
        return new ExpressionLanguage(new FactoryClassFactory($namespace), $culture);
    }
}
