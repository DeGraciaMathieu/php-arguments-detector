[![build](https://github.com/DeGraciaMathieu/php-arguments-detector/actions/workflows/build.yml/badge.svg?branch=main)](https://github.com/DeGraciaMathieu/php-arguments-detector/actions/workflows/build.yml)
# php arguments detector
> The ideal number of arguments for a function is zero. ~ Robert C. Martin

Keep control over the complexity of your methods by checking that they do not have too many arguments with this package.
## Installation
Requires >= PHP 7.4
```
composer require degraciamathieu/php-arguments-detector
```
## Basic usage
```
vendor/bin/phpargsdetector inspect src
```
## Options
```
vendor/bin/phpargsdetector inspect src --without-constructor
```
```
vendor/bin/phpargsdetector inspect src --min=2 --max=5
```
