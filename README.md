# Convention checks PHPro

This package is to be required on all symfony based projects

```bash
composer require --dev phpro/conventions roave/security-advisories
```

# Installation
When requiring this package, it will copy following files to your project root, as long as they don't exist.

```
phpstan.neon
grumphp.yml
.php_cs.php
```

If these files already exist, please remove them and use the conventions instead.