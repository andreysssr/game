<?php

namespace service;

class View
{
    private array $config = [];

    private array $header = [];
    private array $columnWidth = [];
    private int $columnWidthAll = 0;
    private int $padding = 1;
    private array $structure = [];
    private array $table = [];
    private array $rows = [];

    private array $dom = [];

    public function __construct(array $config)
    {
//        echo __METHOD__ . PHP_EOL;
//        echo "hi";
        $this->config = $config;
    }

    // [заголовок 1, заголовок 2, заголовок 3]
    public function addHeader(array $header){
        $this->header = $header;
    }

    // [120, 60, 70]
    public function setColumnWidth(array $columnWidth)
    {
        $this->columnWidth = $columnWidth;
    }

    // 1
    public function setPadding(int $padding)
    {
        $this->padding = $padding;
    }

    // ["name", "result", "optimalSteps"]
    public function setStructure(array $structure)
    {
        $this->structure = $structure;
    }

    // array table
    public function addTable(array $table)
    {
        $this->table = $table;
    }

    // [PHP, 1994]
    public function addRow(array $row)
    {
        $this->rows[] = $row;
    }

    public function render()
    {
        /*
         - определяем максимальную длину для каждой колонки
            -- проверяем header
            -- проверяем rows
            -- проверяем таблицу
            -- проверяем установленные параметры


         * */
    }

    public function test(){
        echo "+----------+------+" . PHP_EOL;
        echo "| Language | Year |" . PHP_EOL;
        echo "+----------+------+" . PHP_EOL;
        echo "| PHP      | 1994 |" . PHP_EOL;
        echo "| C++      | 1983 |" . PHP_EOL;
        echo "| C        | 1970 |" . PHP_EOL;
        echo "+----------+------+" . PHP_EOL;
    }
}