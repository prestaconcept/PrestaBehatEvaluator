<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Application;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private function getConfigDir(): string
    {
        return $this->getProjectDir() . '/tests/Application/config';
    }
}
