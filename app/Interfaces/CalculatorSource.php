<?php

namespace App\Interfaces;

interface CalculatorSource
{
    /**
     * Char used for Quit from program, `q` letter
     */
    const EXIT_CHAR = 113;

    /**
     * Clear all previous values from memory, `c` letter
     */
    const CLEAR_CHAR = 99;

    /**
     * Read data from resource
     *
     * @return mixed
     */
    public function read();

    /**
     * Write data to output
     *
     * @return mixed
     */
    public function write();
}
