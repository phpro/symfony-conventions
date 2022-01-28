# Convention checks PHPro

This package is to be required on all symfony based projects

```bash
composer require --dev phpro/conventions roave/security-advisories
```

## Configuration
Change your grumphp file to this:
```yaml
imports:
    - { resource: vendor/phpro/conventions/grumphp.yml }
```

## Overridable parameters

These parameters can be overridden in your local grumphp file

```yaml
parameters:
    phpstan.config: "vendor/phpro/conventions/phpstan.neon"
    phpstan.level: 'max''
    phpcsfixer2.config: "vendor/phpro/conventions/.php_cs.dist"
    phpparser.ignore:
        - vendor
        - config
        - tests/bootstrap.php
        - Tests/bootstrap.php
        - src/Kernel.php
    phpstan.ignore:
        - "tests/"
        - "Tests/"
        - "vendor/"
        - "var/"
        - "src/Migrations/"
        - "spec/"
```