<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage;

use Presta\BehatEvaluator\ExpressionLanguage\ExpressionFunction\ConstantExpressionFunction;
use Presta\BehatEvaluator\ExpressionLanguage\ExpressionFunction\DateTimeExpressionFunction;
use Presta\BehatEvaluator\ExpressionLanguage\ExpressionFunction\DateTimeImmutableExpressionFunction;
use Presta\BehatEvaluator\ExpressionLanguage\ExpressionFunction\FactoryExpressionFunction;
use Presta\BehatEvaluator\Foundry\FactoryClassFactory;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

final class BehatExpressionLanguageProvider implements ExpressionFunctionProviderInterface
{
    public function __construct(
        private readonly FactoryClassFactory $factoryClassFactory,
        private readonly string $culture,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new ConstantExpressionFunction(),
            new DateTimeExpressionFunction($this->culture),
            new DateTimeImmutableExpressionFunction($this->culture),
            new FactoryExpressionFunction($this->factoryClassFactory),
        ];
    }
}
