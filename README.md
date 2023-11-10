## Override attribute experiment

### About
 - Use rector to automatically add the new PHP 8.3 `#[Override]` attribute
 - Use PHPStan to check that methods marked with `#[Override]` actually override and the inverse that methods that override are marked with `#[Override]`

### Usage
 * Clone repository
 * `composer install`
 * Run `vendor/bin/phpstan` to show that the override attribute is verified (3 errors expected)
 * Run `vendor/bin/rector` to add `Override` attribute (2 changes expected)
 * Run `vendor/bin/phpstan` to show that the override attribute is verified (1 error expected)

### How it works
 * Rector is configured to add the `#[Override]` attribute for overridden methods (see [rector.php](./rector.php)
 * Custom PHPStan rule to verify the `#[Override]` attribute (see [`nfq\ore\PhpStan\OverrideAttributeRule`](./src/PhpStan/OverrideAttributeRule.php))
   * Registered in [phpstan.neon](./phpstan.neon)
 * Polyfill for the `#[Override]` attribute (see [polyfill.php](./polyfill.php))
   * Loaded in `autoload.files.0` (see [composer.json](./composer.json))