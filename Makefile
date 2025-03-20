install:
	composer install

load:
	composer dump-autoload

lint:
	composer exec phpcs -- --standard=PSR12 app routes tests

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src tests

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

test-coverage-text:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-text

setup:
	composer install
	cp -n .env.example .env
	php artisan key:gen --ansi
	php artisan migrate
	php artisan db:seed
	npm ci
	npm run build