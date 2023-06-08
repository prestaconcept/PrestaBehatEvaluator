<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator;

use Presta\BehatEvaluator\Adapter\AdapterInterface;

final class Evaluator implements AdapterInterface
{
    /**
     * @param iterable<AdapterInterface> $adapters
     */
    public function __construct(private readonly iterable $adapters)
    {
    }

    public function __invoke(mixed $value): mixed
    {
        foreach ($this->adapters as $evaluate) {
            $value = $evaluate($value);
        }

        return $value;
    }
}
