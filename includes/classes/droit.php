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
        $query = getPdo()->prepare('SELECT statut FROM droit');

        $query->execute();    

        $i = 0;
        // echo "<table>";
        // echo "<tr>";
        // echo "<th>id_droits</th>";
        // echo "<th>statut</th>";
        // echo "<th>FK_id_membre</th>";
        // echo "</tr>";
        while ($row = $query->fetch()) {

            // echo "<td>" . $row['id_droits'] . "</td>";
            $statut[$i++] = $row['statut'];
            // echo "<td>" . $row['FK_id_membre'] . "</td>";

        }
        // echo "</table>";

        return $statut;

        // print '<label for="manager">Administrateur </label>';

        // print '<select name="manager"  id="manager" required>';

        // $query = getPdo()->prepare('SELECT statut FROM droit');

        // $query->execute();    

        // while ($row = $query->fetch())
        // {         
        //     print '<option value="'.$row['statut'].'">';
        //     print $row['statut'];
        //     print '</option>';
        // } 
        // print '</select>';
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
    public function updateDroit(string $pseudo, string $statut)
    {

        $queryId_compte = getPdo()->prepare('SELECT id_compte FROM compte 
        WHERE pseudo = :pseudo');

        $queryId_compte->execute([
            'pseudo' => $pseudo
        ]);   


        $query = getPdo()->prepare('UPDATE droit 
        SET statut = :statut
        WHERE FK_id_membre = :FK_id_membre');

        $query->execute([
        'statut' => $statut,
        'FK_id_membre' => $queryId_compte
        ]);
        
    }

        /**
     * Update un Droit à une personne donnée
     *
     * @param string $statut : Modérateur, Administrateur, Super-administrateur
     */
    public function getPseudo()
    {
        $query = getPdo()->prepare('SELECT pseudo FROM compte');

        $query->execute();   

        $i = 0;

        while ($row = $query->fetch()) { 

            $pseudo[$i++] = $row['pseudo'];
        }
        return $pseudo;
    }

}

