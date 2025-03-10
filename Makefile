install:
	composer install

load:
	composer dump-autoload

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src tests parsers

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src tests

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

test-coverage-text:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-text