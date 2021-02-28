<?php

class Event
{
    private $id;
    private $name;
    private $description;
    private $start;
    private $end;
    /**
     * Getter
     */

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string
    {
        return $this->description ?? '';
    }
    public function getStart(): string
    {
        return $this->start;
    }
    public function getEnd(): string
    {
        return $this->end;
    }

    /**
     * Setter
     */

    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setDescription(string $description)
    {
        $this->description = $description;
    }
    public function setStart(string $start)
    {
        $this->start = $start;
    }
    public function setEnd(string $end)
    {
        $this->end = $end;
    }


    /**
     * On convertit une string en DateTime en fonction du @case, 0 == start / 1 == end
     */
    public function convertDateTime(bool $case): DateTime
    {
        switch ($case) {
            case 0:
                $time = (new DateTime($this->getStart()));
                break;
            case 1:
                $time = (new DateTime($this->getEnd()));
                break;
        }
        return $time;
    }
}
