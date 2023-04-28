<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage;

use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage as BaseExpressionLanguage;

final class ExpressionLanguage extends BaseExpressionLanguage
{
    public function __construct(string $culture, CacheItemPoolInterface $cache = null, array $providers = [])
    {
        $providers = [
            new BehatExpressionLanguageProvider($culture),
            ...$providers,
        ];

        parent::__construct($cache, $providers);
    }
}
