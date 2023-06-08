<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Adapter;

interface AdapterInterface
{
    public function __invoke(mixed $value): mixed;
}
