<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage;

use Presta\BehatEvaluator\Foundry\FactoryClassFactory;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage as BaseExpressionLanguage;

final class ExpressionLanguage extends BaseExpressionLanguage
{
    public function __construct(
        FactoryClassFactory $factoryClassFactory,
        string $culture,
        CacheItemPoolInterface $cache = null,
        array $providers = [],
    ) {
        $providers = [
            new BehatExpressionLanguageProvider($factoryClassFactory, $culture),
            ...$providers,
        ];

        parent::__construct($cache, $providers);
    }
}
