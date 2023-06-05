<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Resources;

use Doctrine\Inflector\InflectorFactory;
use Presta\BehatEvaluator\ExpressionLanguage\ExpressionLanguage;
use Presta\BehatEvaluator\Foundry\FactoryClassFactory;

final class ExpressionLanguageFactory
{
    public static function create(): ExpressionLanguage
    {
        return new ExpressionLanguage(
            new FactoryClassFactory(
                'Presta\\BehatEvaluator\\Tests\\Application\\Foundry\\Factory\\',
                InflectorFactory::create()->build(),
            ),
            'fr_FR',
        );
    }
}
