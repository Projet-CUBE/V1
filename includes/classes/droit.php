<?php

/**
 * Donne un Droit à une personne donnée
 *
 * @param string $statut : Modérateur, Administrateur, Super-administrateur
 */
class droit
{
    public function getDroit() 
    {
        // 
        $query = getPdo()->prepare('SELECT * FROM droit');

        $query->execute();    

        echo "<table>";
        echo "<tr>";
        echo "<th>id_droits</th>";
        echo "<th>statut</th>";
        echo "<th>FK_id_membre</th>";
        echo "</tr>";
        while ($row = $query->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['id_droits'] . "</td>";
            echo "<td>" . $row['statut'] . "</td>";
            echo "<td>" . $row['FK_id_membre'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function insertDroit(string $statut)
    {
        // 
        $query = getPdo()->prepare('INSERT INTO droit (statut, FK_id_membre) 
        VALUES (:statut, :FK_id_membre )');

        $query->execute([
        'statut' => $statut,
        'FK_id_membre' => $_SESSION['id_compte']
        ]);        
    }

    /**
     * Update un Droit à une personne donnée
     *
     * @param string $statut : Modérateur, Administrateur, Super-administrateur
     */
    public function updateDroit(string $statut)
    {
        $query = getPdo()->prepare('UPDATE droit 
        SET statut = :statut
        WHERE FK_id_membre = :FK_id_membre');

        $query->execute([
        'nom' => $statut,
        'FK_id_membre' => $_SESSION['id_compte']
        ]);
    }
}