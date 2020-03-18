<?php

require __DIR__ . '/vendor/autoload.php';

use App\Sources\CommandLineSource;
use App\Calculator;

$calculator = new Calculator(new CommandLineSource());
$calculator->run();


//echo '>';
//echo $operand = trim(fgets(STDIN)); // читает одну строку из STDIN
//echo PHP_EOL;
//
//echo '>' . eval("return $first $operand $second;");
//echo PHP_EOL;
