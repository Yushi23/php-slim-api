install:
	composer install
	composer dump-autoload

start:
	php -S localhost:8888

test:
	composer exec --verbose phpunit tests
