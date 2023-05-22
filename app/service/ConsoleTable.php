<?php

namespace app\service;

class ConsoleTable
{
    private array $headers = [];
    private array $rows = [];
    private array $result = [];

    public function render($params){
        $this->setHeaders($params['header']);
        $this->addTable($params['table']);
        $this->prepare();
        return $this->result;
    }

    private function setHeaders($headers) {
        $this->headers = $headers;
    }

    private function addTable($tabl){
        foreach ($tabl as $row) {
            $this->addRow($row);
        }
    }

    private function addRow($row) {
        $this->rows[] = $row;
    }

    private function prepare() {
        $columnWidths = [];

        foreach ($this->headers as $header) {
            $columnWidths[] = mb_strlen($header);
        }

        foreach ($this->rows as $row) {
            foreach ($row as $i => $value) {
                $columnWidths[$i] = max($columnWidths[$i], mb_strlen($value));
            }
        }

        $this->createStructureTable($columnWidths, $this->headers, $this->rows);
    }

    private function createStructureTable($columnWidths, $headers, $rows){
        $this->createSeparator($columnWidths);
        $this->createRow($headers, $columnWidths);
        $this->createSeparator($columnWidths);

        foreach ($rows as $row) {
            $this->createRow($row, $columnWidths);
        }

        $this->createSeparator($columnWidths);
    }

    private function createRow($row, $columnWidths) {
        $str = "|";
        foreach ($row as $i => $value) {
            $str .= " " . $value . str_repeat(" ", $columnWidths[$i] - mb_strlen($value)) . " |";
        }
        $str .= "\n";

        $this->result[] = $str;
    }

    private function createSeparator($columnWidths) {
        $str = "+";
        foreach ($columnWidths as $width) {
            $str .= "-" . str_repeat("-", $width) . "-+";
        }
        $str .= "\n";

        $this->result[] = $str;
    }
}

//$view = new ViewConsoleTable();
//$result = $view->render([
//    'header' => [
//        'Имя игрока',
//        'Финишировал',
//        'Сделанных ходов',
//        'Минимальных ходов'
//    ],
//    'table' => [
//        ['Андрей Андрей', 'да', '5', '4'],
//        ['Игорь', 'нет', '6', '6'],
//    ]
//]);

//$result = $view->render([
//    'header' => [
//        'Name gamers',
//        'Finished',
//        'Current steps',
//        'Minimal current steps'
//    ],
//    'table' => [
//        ['Andrey Andrey', 'yea', '5', '4'],
//        ['Igor', 'no', '6', '6'],
//    ]
//]);

//print_r($result);
