# Solution for TL-test problem 1
µservice that calculates discount(s) for given order.

### Setup
To get the service working do these steps:
```shell
composer install
cd public
php -S localhost:8080  index.php
```
### How to use
Go to [localhost:8080](http://localhost:8080) and check out the discounting.

### Tests
```shell
cd vendor/bin
phpunit --bootstrap ../../vendor/autoload.php ../../tests
```