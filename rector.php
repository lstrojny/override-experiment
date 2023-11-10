<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Php83\Rector\ClassMethod\AddOverrideAttributeToOverriddenMethodsRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
    ]);

    $rectorConfig->importNames();

    # We force the PHP version to 8.3 so that Rector assumes that the #[Override] attribute is already supported
    $rectorConfig->phpVersion(PhpVersion::PHP_83);

    # Register the rector that adds the Override attribute
    $rectorConfig->rule(AddOverrideAttributeToOverriddenMethodsRector::class);
};
