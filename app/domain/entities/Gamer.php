<?php

namespace app\domain\entities;

class Gamer
{
    private string $name;
    private string $urlStart;
    private string $urlSelected;
    private string $urlStop;
    private array $linksToUrlStop;
    private int $countSteps = 0;
    private int $countStepsMin = 0;
    private bool $linkFound = false;
    private bool $activeGamer = true;
    private bool $stopPlay = false;

    public function __construct($name, $urls, array $linksToUrlStop)
    {
        $this->name = $name;
        $this->urlStart = $urls['start'];
        $this->urlStop = $urls['stop'];
        $this->urlSelected = $urls['start'];
        $this->linksToUrlStop = $linksToUrlStop;
    }

    public function isActive()
    {
        return ($this->activeGamer) && (!$this->stopPlay);
    }

    public function stopPlay():void
    {
        $this->stopPlay = true;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setUrlSelected(string $urlSelected): void
    {
        $this->urlSelected = $urlSelected;

        $this->changeCountSteps();
    }

    public function isFinished(){
        return $this->stopPlay;
    }

    public function finished()
    {
        $this->activeGamer = false;
    }

    private function changeCountSteps()
    {
        ++$this->countSteps;
    }

    public function getUrlStop()
    {
        return $this->urlStop;
    }

    public function getUrlSelected()
    {
        return $this->urlSelected ?? $this->urlStart;
    }

    public function getLinksToUrlStop(){
        return $this->linksToUrlStop;
    }

    public function isLinkFound()
    {
        return $this->linkFound;
    }

    public function changeLinkFound()
    {
        $this->linkFound = true;
        $this->countStepsMin = $this->countSteps + 1;
    }

    public function getCountSteps(){
        return $this->countSteps;
    }

    public function getCountStepsMin(){
        return ($this->countStepsMin == 0) ? $this->countSteps : $this->countStepsMin;
    }
}
