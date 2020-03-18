<?php

require __DIR__ . '/vendor/autoload.php';

use App\Sources\CommandLineSource;
use App\Calculator;

$calculator = new Calculator(new CommandLineSource());
$calculator->run();
