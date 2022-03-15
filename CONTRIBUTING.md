# Contributing

## Flex

You can test flex recipes on an empty Symfony install.
In following snippet, you will have to replace `YOURFORK` and `YOURBRANCH` with your local configuration.

These commands can be used to test it out:

### Rebuild the recipes and index:
```bash
FLEX_BRANCH=YOURBRANCH FLEX_FORK=YOURFORK php scripts/build-flex.php
```

### Test the recipes

```bash
symfony new conventiontest
cd conventiontest

composer config repositories.conventions git https://github.com/YOURFORK/symfony-conventions.git

composer config --json extra.symfony.allow-contrib true
composer config --json extra.symfony.endpoint '["https://api.github.com/repos/YOURFORK/symfony-conventions/contents/index.json?ref=YOURBRANCH", "flex://defaults"]'

composer require --dev phpro/symfony-conventions:YOURBRANCH

# If you want to rerun a recipe:
composer recipes:install phpro/symfony-conventions --force -v
```

*Note*: If you add a git repository, you must push changes to the recipes before you can test them.
