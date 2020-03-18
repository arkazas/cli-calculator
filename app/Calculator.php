<?php

namespace App;

use App\Interfaces\CalculatorSource;

class Calculator
{
    /**
     * @var CalculatorSource $source
     */
    protected $source;

    /**
     * @var array $validationData
     */
    protected $validationData = [];

    /**
     * @var array $data
     */
    protected $data = [];

    /**
     * @var int
     */
    protected $result = null;

    /**
     * Calculator constructor.
     *
     * @param CalculatorSource $source
     */
    public function __construct(CalculatorSource $source)
    {
        $this->source = $source;
    }

    /**
     * @param string $line
     *
     * @return bool
     */
    protected function validate(string $line): bool
    {
        preg_match('/^(([0-9]|\-|\+|\*|\/) *)*/', $line, $this->validationData);

        return empty($this->validationData[0]);
    }

    /**
     * Run calculator function
     */
    public function run(): void
    {
        while(!feof($this->source->getResource())) {
            echo '>';
            $line = $this->source->read();

            if (ord($line) == CalculatorSource::EXIT_CHAR) {
                break;
            }

            if (ord($line) == CalculatorSource::CLEAR_CHAR) {
                $this->setDefaults();

                continue;
            }

            if ($this->validate($line)) {
                $this->print('Incorrect char value, please type numbers or one of the next operations: + - * /');

                continue;
            }

            $this->compute($line);
        }

        $this->print('Bye bye');
    }

    /**
     * Set defaults values
     */
    protected function setDefaults(): void
    {
        $this->data = [];
        $this->result = null;

        $this->print('Data cleared');
    }

    /**
     * @param string $line
     */
    protected function compute(string $line): void
    {
        $data = explode(' ', $line);

        foreach ($data as $key => $value) {
            $this->calc($value);
        }

        (!is_null($this->result)) ? $this->print($this->result) : $this->print($line);
    }

    /**
     * @param string $value
     *
     * @return void
     */
    protected function calc(string $value): void
    {
        if (is_numeric($value)) {
            $this->data[] = $value;

            return ;
        }

        $count = count($this->data);

        if (!isset($this->data[$count-2])) {
            $this->print('Please, type the second argument');

            return;
        }

        $this->data[$count-2] = $this->result = eval("
                    return {$this->data[$count-2]}
                     $value 
                     {$this->data[$count-1]};
                ");

        array_pop($this->data);

        return;
    }

    /**
     * Show bye message
     *
     * @param string $msg
     */
    protected function print(string $msg): void
    {
        echo $msg . PHP_EOL;
    }
}
