<?php

class events
{
    /**
     * Récupère les évènements commençant entre 2 dates
     */
    public function getEventsBetween(DateTime $start, DateTime $end): array
    {

        $query = getPdo()->prepare("SELECT * FROM evenements WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND
         '{$end->format('Y-m-d 23:59:59')}' ORDER BY start ASC");
        $query->execute();
        $results = $query->fetchAll();
        return $results;
    }


    /**
     * Récupère les évènements commençant entre 2 dates indexé par jour
     */

    public function getEventsBetweenByDay(DateTime $start, DateTime $end): array
    {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach ($events as $event) {
            $date = explode(' ', $event['start'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            } else {
                $days[$date][] = $event;
            }
        }
        return $days;
    }
    /**
     * Récupère un évènement
     */
    public function find(int $id): Event
    {
        $query = getPdo()->query("SELECT * FROM evenements WHERE id_event = $id LIMIT 1");
        $query->setFetchMode(PDO::FETCH_CLASS, Event::class);

        $result = $query->fetch();
        if ($result === false) {
            throw new Exception('Aucun résultat n\'a été trouvé');
        }
        return $result;
    }


    public function hydrate(Event $event, array $data, $member)
    {
        $event->setName($data['name']);
        $event->setDescription($data['description']);
        $event->setStart(DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['start'])->format('Y-m-d H:i:s'));
        $event->setEnd(DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['end'])->format('Y-m-d H:i:s'));
        $member->get('id_compte');
        return $event;
    }
    /**
     * Créer un évènement au niveau bdd
     */
    public function create(Event $event, $member): bool
    {
        $statement = getPdo()->prepare('INSERT INTO evenements (name, description, start, end, id_compte) VALUES (?, ?, ?, ?, ?)');
        return $statement->execute([
            $event->getName(),
            $event->getDescription(),
            $event->convertDateTime(0)->format('Y-m-d H:i:s'),
            $event->convertDateTime(1)->format('Y-m-d H:i:s'),
            $member->get('id_compte'),
        ]);
    }
    /**
     * Modifier un évènement au niveau bdd
     */
    public function update(Event $event, $member): bool
    {
        $statement = getPdo()->prepare('UPDATE evenements SET name = ?, description = ?, start = ?, end = ?, id_compte = ? WHERE id_event = ?');
        return $statement->execute([
            $event->getName(),
            $event->getDescription(),
            $event->convertDateTime(0)->format('Y-m-d H:i:s'),
            $event->convertDateTime(1)->format('Y-m-d H:i:s'),
            $event->getId(),
            $member->get('id_compte')
        ]);
    }

    /**
     * TODO: Supprime un évènement
     */
    public function delete(Event $event, $member)
    {
        $member_compare = $member->get('id_compte');
        $event_compare = $event->getIdCompte();
        if ($member_compare === $event_compare) {
            $statement = getPdo()->prepare('DELETE FROM evenements WHERE id_event = ? & id_compte = ? ');
            return $statement->execute([
                $event->getId(),
                $member->get('id_compte')
            ]);
        } else {
            echo ('Tu ne peux pas supprimer un event que tu n\'as pas créer');
        }
    }
}
