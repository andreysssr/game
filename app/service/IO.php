<?php

namespace app\service;

class IO
{
    private View $view;

    public function __construct(View $view)
    {

        $this->view = $view;
    }

    public function getNumberPositiveOrZero($message = '')
    {
        while(true){
            $this->view->print($message);
            $input = readline();

            if (is_numeric($input) and (0 <= (int) $input)){
                return (int) $input;
            }
        }
    }

    public function getInput($message)
    {
        $this->view->print($message);
        return readline();
    }
}
