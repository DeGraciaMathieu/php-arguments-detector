[![build](https://github.com/DeGraciaMathieu/php-arguments-detector/actions/workflows/build.yml/badge.svg?branch=main)](https://github.com/DeGraciaMathieu/php-arguments-detector/actions/workflows/build.yml)
# php arguments detector
> The ideal number of arguments for a function is zero. ~ Robert C. Martin

Keep control over the complexity of your methods by checking that they do not have too many arguments with this package.
## Installation
Requires >= PHP 7.3
```
composer require degraciamathieu/php-arguments-detector
```
## Basic usage
```
vendor/bin/phpargsdetector inspect {folder} {--without-constructor} {--min=} {--max=}
```
## Example
```
vendor/bin/phpargsdetector inspect app/Http

+----------------------------------------------------------+------------+-----------+
| Files                                                    | Methods    | Arguments |
+----------------------------------------------------------+------------+-----------+
| /var/www/app/Http/Middleware/Authenticate.php            | redirectTo | 1         |
| /var/www/app/Http/Middleware/HandleInertiaRequests.php   | version    | 1         |
| /var/www/app/Http/Middleware/HandleInertiaRequests.php   | share      | 1         |
| /var/www/app/Http/Middleware/RedirectIfAuthenticated.php | handle     | 3         |
| /var/www/app/Http/Middleware/TrustHosts.php              | hosts      | 0         |
+----------------------------------------------------------+------------+-----------+
Total of methods : 5
```
