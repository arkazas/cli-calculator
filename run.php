<?php

require __DIR__ . '/vendor/autoload.php';

use App\Sources\CommandLineSource;
use App\Calculator;

var_dump($argv[1]);
die();

$calculator = new Calculator(new CommandLineSource());
$calculator->run();
