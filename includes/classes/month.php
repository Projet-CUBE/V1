<?php

class month
{


    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    public $month;
    public $year;


    /**
     * @param int $month Le mois compris entre 1 et 12
     * @param int $year L'année
     */
    public function __construct(?int $month = null, ?int $year = null)
    {
        if ($month === null || $month < 1 || $month > 12) {
            $month = intval(date('m'));
        }
        if ($year === null || $month < 1 || $month > 12) {
            $year = intval(date('Y'));
        }
        if ($year < 1970) {
            throw new Exception("L'année est inférieure à 1970");
        }
        $this->month = $month;
        $this->year = $year;
    }

    public function getDate(?int $month = null, ?int $year = null)
    {
        if ($month === null || $month < 1 || $month > 12) {
            $month = intval(date('m'));
        }
        if ($year === null || $month < 1 || $month > 12) {
            $year = intval(date('Y'));
        }
        if ($year < 1970) {
            throw new Exception("L'année est inférieure à 1970");
        }
        $this->month = $month;
        $this->year = $year;
    }
    /**
     * Renvoie le premier jour du mois
     * @return Datetime
     */
    public function getStartingDay(): DateTime
    {
        return new DateTime("{$this->year}-{$this->month}-01");
    }

    /**
     * Renvoie le mois en toute lettre (ex: Février 2021)
     */
    public function toString(): string
    {
        return $this->months[$this->month - 1] . ' ' . $this->year;
    }

    /**
     * Renvoie le mois actuel
     */
    public function getMonth(): string{
        return $this->months[$this->month - 1];
    }
    /**
     * Renvoie le nombre de semaines dans le mois
     */
    public function getWeeks(): int
    {
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $weeks = intval($end->format('W')) - intval($start->format('W')) + 1;
        if ($weeks < 0) {
            $weeks = intval($end->format('W'));
        }
        return $weeks;
    }

    /**
     * Est ce que le jour est dans le mois en cours ?
     */
    public function withinMonth(DateTime $date): bool
    {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }

    /**
     * Renvoie le mois suivant
     */
    public function nextMonth(): month
    {
        $month = $this->month + 1;
        $year = $this->year;

        if ($month > 12) {
            $month = 1;
            $year += 1;
        }
        return new month($month, $year);
    }

    /**
     * Renvoie le mois précédent
     */
    public function previousMonth(): month
    {
        $month = $this->month - 1;
        $year = $this->year;

        if ($month < 1) {
            $month = 12;
            $year -= 1;
        }
        return new month($month, $year);
    }
}
