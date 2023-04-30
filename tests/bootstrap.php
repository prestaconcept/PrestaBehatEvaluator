<?php

declare(strict_types=1);

use Symfony\Component\Filesystem\Filesystem;

require dirname(__DIR__) . '/vendor/autoload.php';

$filesystem = new Filesystem();
$filesystem->remove(dirname(__DIR__) . '/var/cache/test');
