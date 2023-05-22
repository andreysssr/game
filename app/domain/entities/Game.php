<?php

namespace app\domain\entities;

use app\service\CheckLinks;
use app\service\Wiki;

class Game
{
    private int $countGamers;
    private int $countActiveGamers = 0;
    private Wiki $wiki;
    private CheckLinks $checkLinks;
    private $registerGamers = [];

    private $currentGamer = 0;

    public function __construct(Wiki $wiki, CheckLinks $checkLinks)
    {
        $this->wiki = $wiki;
        $this->checkLinks = $checkLinks;
    }

    public function setGamers($countGamers)
    {
        $this->countGamers = $countGamers;
        $this->countActiveGamers = $countGamers;
    }

    public function isActive()
    {
        return $this->countActiveGamers > 0;
    }

    public function alloweRegisterGamer()
    {
        return !($this->countGamers == count($this->registerGamers));
    }

    public function addGamers(Gamer $gamer)
    {
        if (!$this->alloweRegisterGamer()) {
            throw new \Exception("Добавление игроков не доступно");
        }

        $this->registerGamers[] = $gamer;
    }

    public function getNewStepProperty()
    {
        $currentGamer = $this->registerGamers[$this->currentGamer];

        return [
            'id' => $this->currentGamer,
            'name' => $currentGamer->getName(),
            'urlStop' => $currentGamer->getUrlStop(),
            'listUrl' => $this->wiki->getLinksOnPage($currentGamer->getUrlSelected()),
        ];
    }

    public function setStepProperty($property): void
    {
        $currentGamer = $this->registerGamers[$this->currentGamer];
        $currentGamer->setUrlSelected($property['urlSelected']);

        if (!$currentGamer->isLinkFound()) {
            if ($this->checkLinks->check($currentGamer->getLinksToUrlStop(), $property['listUrl'])) {
                $currentGamer->changeLinkFound();
            }
        }

        if ($property['urlSelected'] == $currentGamer->getUrlStop()) {
            $currentGamer->finished();

            --$this->countActiveGamers;
        }

        $this->changeCurrentGamer();
    }

    public function stopPlayGamer($id){
        $this->registerGamers[$id]->stopPlay();
        --$this->countActiveGamers;
    }

    private function changeCurrentGamer()
    {
        if (($this->currentGamer + 1) == count($this->registerGamers))
        {
            for($i = 0, $iMax = count($this->registerGamers); $i< $iMax; $i++){
                if($this->registerGamers[$i]->isActive()){
                    $this->currentGamer = $i;
                    break;
                }
            }
        }else{
            for($i = $this->currentGamer + 1, $iMax = count($this->registerGamers); $i < $iMax; $i++){
                if($this->registerGamers[$i]->isActive()){
                    $this->currentGamer = $i;
                    break;
                }
            }
        }
    }

    public function getResultGame(): mixed
    {
        $resultGame = [];

        foreach ($this->registerGamers as $id => $gamer){
            $resultGame[$id] = [
                $gamer->getName(),
                $gamer->isFinished() ? 'да' : 'нет',
                (string) $gamer->getCountSteps(),
                (string) $gamer->getCountStepsMin(),
            ];
        }

        return $resultGame;
    }
}
