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
grumphp:
    tasks:
#        git_commit_message:
#            allow_empty_message: false
#            enforce_capitalized_subject: false
#            enforce_no_subject_trailing_period: true
#            enforce_single_lined_subject: false
#            max_body_width: 9999
#            max_subject_width: 9999
#            matchers:
#                commit_matcher: /^.*$/
#            case_insensitive: true
#            multiline: true
#            additional_modifiers: ''
#            metadata:
#                priority: 300
```

## Overridable parameters

These parameters can be overridden in your local grumphp file

```yaml
parameters:
    phpstan.config: "vendor/phpro/conventions/phpstan.neon"
    phpstan.level: 'max'
    phpcsfixer2.config: "vendor/phpro/conventions/.php_cs.dist"
    phpparser.ignore:
        - vendor
        - config
        - tests/bootstrap.php
        - src/Kernel.php
    phpstan.ignore:
        - "tests/"
        - "vendor/"
        - "var/"
        - "migrations/"
        - "spec/"
```