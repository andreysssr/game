<?php

namespace app\domain\entities;

use app\service\CheckLinks;
use app\service\WikiApi;
use core\Container\Container;

class Game
{
    use EventTrait;

    private mixed $id;
    private int $countGamers = 0; // для цикла выбора следующих игроков
    private int $countActiveGamers = 0;
    private int $currentGamer = 0;
    private array $listNextGamers = [];

    private $wiki;
    private $checkLinks;

    public function __construct($id, $countGamers, WikiApi $wiki, CheckLinks $checkLinks)
    {
        $this->id = $id;
        $this->countGamers = $countGamers;
        $this->countActiveGamers = $countGamers;

        $this->wiki = $wiki;
        $this->checkLinks = $checkLinks;
    }

    public function getId(){
        return $this->id;
    }

    public function addGamer(Gamer $gamer): void
    {
        $this->listNextGamers[] = ['active' => true, 'name' => $gamer->getName(), 'id' => $gamer->getId()];
    }

    public function changeCountActiveGamers(): bool
    {
        return --$this->countActiveGamers;

        // проверка активна ли игра
        // если не активна - регистрация события - GameOver
        // регистрация события уменьшения количества игроков
    }

    public function isActiveGame(): bool
    {
        return !($this->countActiveGamers == 0);
    }

    public function getPlayParams()
    {
        $response = [
            "idGamer" => 7, // $listNextGamers
            "listUrl" => [],
        ];

//        $this->nextStepGame();
//
//        if (! $this->isActiveGame()){
//            // регистрируем сообщение - игра остановлена
//        }
/*

[ checkPlayParams() ]
получаем id текущего игрока
получаем его выбранную страницу

получаем список ссылок с выбранной страницы
    проверяем перекрёстно каждую полученную ссылку на присутствие в списке
        если нашлась
            останавливаем проверку
            регистрируем событие - для записи минимального шага
выводим список ссылок с выбранной страницы

проверяем (выбранная страница == финишная страница)
    если да
        регистрируем сообщение
            для игрока меняем active на false
            уменьшаем количество активных игроков в игре
            проверяем статус игры

проверяем статус игры
    если игра не активна
        регистрируем сообщение - игра остановлена
*/
    }

    public function checkPlayParams($params)
    {
        $params = [
            "idGame" => $this->getId(),
            "idGamer" => 7, // $listNextGamers
            "selectedUrl" => "",
        ];
    }

    public function getResultGame()
    {
        return [
//            [$this->]
        ];
    }

/*

if ($game->isActiveGame()){
    $response = $game->getPlayParams()
    $game->setPlayParams($request)
}else{
    $response = $game->getResultGame()
}

*/


}
