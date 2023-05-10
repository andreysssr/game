<?php

namespace app\domain\entities;

class Gamer
{
    use EventTrait;

    private mixed $id;
    private string $name;
    private string $urlStart;
    private string $urlStop;
    private int $countSteps = 0;
    private int $countStepsMin = 0;
    private bool $activeGamer = true;
    // массив ссылок на финишную страницу
    private array $linksToUrlStop;

    public function __construct($id, $dto)
    {
        $this->id = $id;
        $this->name = $dto->name;
        $this->urlStart = $dto->urlStart;
        $this->urlStop = $dto->urlStop;
        $this->linksToUrlStop = $dto->linksToUrlStop;
    }

    public function getId(): mixed
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountSteps(): int
    {
        return $this->countSteps;
    }

    public function getCountStepsMin(): int
    {
        return $this->countStepsMin;
    }

    public function getUrlStart(): string
    {
        return $this->urlStart;
    }

    public function getUrlStop(): string
    {
        return $this->urlStop;
    }

    public function getLinksToUrlStop(): array
    {
        return $this->linksToUrlStop;
    }

    public function isActiveGamer(): bool
    {
        return $this->activeGamer;
    }

    public function changeStatusGamer(): void
    {
        $this->activeGamer = false;

        $this->registerEvent("GamerFinished", $this);
    }
}
