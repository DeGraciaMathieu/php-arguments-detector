# php arguments detector
> The ideal number of arguments for a function is zero. Arguments are hard, they take a lot of conceptual power. ~ Robert C. Martin
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
