<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\ExpressionFunction;

use Presta\BehatEvaluator\ExpressionLanguage\Compiler\FactoryCompiler;
use Presta\BehatEvaluator\ExpressionLanguage\Evaluator\FactoryEvaluator;
use Presta\BehatEvaluator\Foundry\FactoryClassFactory;
use Symfony\Component\ExpressionLanguage\ExpressionFunction;

final class FactoryExpressionFunction extends ExpressionFunction
{
    public function __construct(FactoryClassFactory $factoryClassFactory)
    {
        parent::__construct('factory', new FactoryCompiler(), new FactoryEvaluator($factoryClassFactory));
    }
}
