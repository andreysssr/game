<?php

namespace app\service;

class View
{
    private ConsoleTable $consoleTable;

    public function __construct(ConsoleTable $consoleTable)
    {
        $this->consoleTable = $consoleTable;
    }

    public function print($message){
        if (is_string($message)){
            echo $message;
        }

        if (is_array($message)){
            foreach ($message as $value){
                echo $value;
            }
        }
    }

    public function printTable($settings){
        $this->print($this->consoleTable->render($settings));
    }
}
