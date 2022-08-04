[![build](https://github.com/DeGraciaMathieu/php-arguments-detector/actions/workflows/build.yml/badge.svg?branch=main)](https://github.com/DeGraciaMathieu/php-arguments-detector/actions/workflows/build.yml)
[![packagist](https://img.shields.io/packagist/v/DeGraciaMathieu/php-arguments-detector)]([https://github.com/DeGraciaMathieu/php-arguments-detector/actions/workflows/build.yml](https://img.shields.io/packagist/v/DeGraciaMathieu/php-arguments-detector))
[![packagist](https://img.shields.io/badge/php%20versions-7.3%20%7C%207.4%20%7C%20%5E8-blue)]([https://img.shields.io/badge/php%20versions-7.3%20%7C%207.4%20%7C%20%5E8-blue](https://img.shields.io/badge/php%20versions-7.3%20%7C%207.4%20%7C%20%5E8-blue))

# php arguments detector
> The ideal number of arguments for a function is zero. ~ Robert C. Martin

Keep control over the complexity of your methods by checking that they do not have too many arguments with this package.
## Installation
Requires >= PHP 7.3
```
composer require degraciamathieu/php-arguments-detector --dev
```
## Usage
```
vendor/bin/phpargsdetector inspect {folder}
```
## Options
| options               | description |
|-----------------------|-------------|
| --min-args=                | Ignore methods with less than --min-args arguments.         |
| --max-args=                | Ignore methods with more than --max-args arguments.         |
| --min-weight=                | Ignore methods with less than --min-weight weight.         |
| --max-weight=                | Ignore methods with more than --max-weight weight.         |
| --limit=              | Number of methods displayed.         |
| --without-constructor | Ignore method constructors from detection.         |
| --sort-by-weight      | Sort the results by the weight of methods.         |
## Examples
```
vendor/bin/phpargsdetector inspect app/Services/Saml/

+------------------------------------------+------------------+-----------+--------+
| Files                                    | Methods          | Arguments | Weight |
+------------------------------------------+------------------+-----------+--------+
| app/Services/Saml/SamlMessageFactory.php | __construct      | 2         | 2      |
| app/Services/Saml/SamlMessageFactory.php | makeSamlResponse | 2         | 68     |
| app/Services/Saml/SamlSecurity.php       | checkSignature   | 2         | 18     |
| app/Services/Saml/SamlIssuer.php         | find             | 1         | 3      |
| app/Services/Saml/SamlKeeper.php         | keep             | 1         | 1      |
| app/Services/Saml/SamlMessageFactory.php | addAttributes    | 1         | 26     |
| app/Services/Saml/SamlMessageFactory.php | sign             | 1         | 12     |
| app/Services/Saml/SamlResponder.php      | launch           | 1         | 10     |
| app/Services/Saml/SamlKeeper.php         | has              | 0         | 0      |
| app/Services/Saml/SamlKeeper.php         | retrieve         | 0         | 0      |
+------------------------------------------+------------------+-----------+--------+
Total of methods : 10
```
```
vendor/bin/phpargsdetector inspect app/ --limit=3 --min-args=2 --without-constructor

+-------------------------------------------------+---------+-----------+--------+
| Files                                           | Methods | Arguments | Weight |
+-------------------------------------------------+---------+-----------+--------+
| app/Http/Middleware/RedirectIfAuthenticated.php | handle  | 3         | 27     |
| app/Http/Controllers/IssuerController.php       | update  | 2         | 24     |
| app/Http/Controllers/RestrictionController.php  | update  | 2         | 28     |
+-------------------------------------------------+---------+-----------+--------+
Total of methods : 3
```
```
vendor/bin/phpargsdetector inspect app/ --limit=3 --sort-by-weight

+-------------------------------------------------+------------------+-----------+--------+
| Files                                           | Methods          | Arguments | Weight |
+-------------------------------------------------+------------------+-----------+--------+
| app/Services/Saml/SamlMessageFactory.php        | makeSamlResponse | 2         | 68     |
| app/Http/Controllers/RestrictionController.php  | update           | 2         | 28     |
| app/Http/Middleware/RedirectIfAuthenticated.php | handle           | 3         | 27     |
+-------------------------------------------------+------------------+-----------+--------+
Total of methods : 3
```
## Weight
The weight is the number of arguments multiplied by the number of lines of the method.

The weight of the `foo` method is 10 : 2 arguments * 5 lines.

```php
class Bar {
    public function foo($a, $b)
    {
        if ($a) {
           //
        }

        return $b;
    }
}
```

You can use it as a complexity indicator.
