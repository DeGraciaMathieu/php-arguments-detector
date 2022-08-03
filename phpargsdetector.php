#!/usr/bin/env php
<?php

use Symfony\Component\Console\Application;
use DeGraciaMathieu\PhpArgsDetector\Commands\InspectCommand;

require __DIR__ . '/vendor/autoload.php';

$application = new Application();

$command = $application->add(new InspectCommand());

$application->run();
