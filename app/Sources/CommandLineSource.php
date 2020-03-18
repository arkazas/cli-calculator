<?php

namespace App\Sources;

use App\Interfaces\CalculatorSource;

class CommandLineSource implements CalculatorSource
{

    /**
     * @return bool|resource
     */
    public function getResource()
    {
        return STDIN;
    }

    /**
     * Read data from cli source
     *
     * @return string
     */
    public function read()
    {
        return trim(fgets(STDIN));
    }

    public function write()
    {

    }
}
