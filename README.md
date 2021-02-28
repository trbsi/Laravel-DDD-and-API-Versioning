# Blog App using DDD and API versioning
Just a CRUD Blog web app with written in DDD.

# Install
- composer install
- add git pre-commit hook

## DDD References
- https://medium.com/@ibrunotome/a-domain-driven-design-ddd-approach-to-the-laravel-framework-18906b3dd473
- https://oliverlundquist.com/2018/03/20/how-to-setup-ddd-in-laravel-app.html
- https://medium.com/@developeruldeserviciu/ddd-usually-means-at-least-3-layers-application-services-domain-service-and-infrastructure-967e80403615

# Versioning
- for versioning we need to switch namespaces, tests and translations

## Versioning References
- https://medium.com/mestredev/versioning-your-rest-api-with-laravel-646bcc1f70a4
- https://shouts.dev/laravel-api-versioning-with-api-key-in-simple-method

# Git hooks
- https://gist.github.com/fesor/1043aec3f1aeac7d801c270e0fba36cd

We need to have ".php_cs" config otherwise if CS-Fixer tries to lint multiple files it will get error "For multiple paths config parameter is required."
```
echo "php-cs-fixer pre commit hook start"

PHP_CS_FIXER="vendor/bin/php-cs-fixer"
PHP_CS_CONFIG=".php_cs"
CHANGED_FILES=$(git diff --cached --name-only --diff-filter=ACM -- '*.php')

if [ -n "$CHANGED_FILES" ]; then
    $PHP_CS_FIXER fix --config "$PHP_CS_CONFIG" $CHANGED_FILES;
    git add $CHANGED_FILES;
fi

echo "php-cs-fixer pre commit hook finish"
```

# Laravel Sail and Docker
- https://tech.osteel.me/posts/you-dont-need-laravel-sail