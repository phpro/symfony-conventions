# GrumPHP Symfony Convention

This package is to be required on all PHPro's symfony based projects.

## Installation

### With symfony/flex

```bash
composer config --json extra.symfony.allow-contrib true
composer config --json extra.symfony.endpoint '["https://api.github.com/repos/phpro/symfony-conventions/contents/index.json", "flex://defaults"]'
composer require --dev phpro/symfony-conventions
```

### Without symfony/flex

```bash
composer require --dev phpro/symfony-conventions
```

You can copy the config files from the `configs/` directory to the root of your project.


## Optional packages based on project requirements:

*Note*: If you already have these dependencies installed, you might have to run the flex recipe only:

```
composer recipes
composer recipes:install THE/DEPENDENCY --force -v
```

### roave/security-advisories 

```bash
composer require --dev roave/security-advisories:dev-master
```

```yaml 
# grumphp.yaml
parameters:
    run_security_advisories: true
```

### phpstan/phpstan

```bash
composer require --dev phpstan/phpstan phpstan/extension-installer symplify/phpstan-rules
```

```yaml 
# grumphp.yaml
parameters:
    run_phpstan: true
```

### vimeo/psalm

```bash
composer require --dev vimeo/psalm psalm/plugin-symfony 
```

```yaml 
# grumphp.yaml
parameters:
    run_psalm: true
```
