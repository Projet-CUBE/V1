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

        $i = 0;

        while ($row = $query->fetch()) {
            $statut[$i++] = $row;
        }

        return $statut;
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
     * @param string $pseudo : Pseudo de la personne à update en droits
     * @param string $statut : Modérateur, Administrateur, Super-administrateur
     */
    public function updateDroit(string $pseudo, string $statut)
    {

        $queryId_compte = getPdo()->prepare('SELECT id_compte FROM compte 
        WHERE pseudo = :pseudo LIMIT 1');

        $queryId_compte->execute([
            'pseudo' => $pseudo
        ]);   

        $Id_compte = $queryId_compte->fetch();

        $query = getPdo()->prepare('UPDATE compte 
        SET FK_id_droit = :FK_id_droit
        WHERE id_compte = :id_compte');

        $query->execute([
        'FK_id_droit' => $statut,
        'id_compte' => $Id_compte['id_compte']
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

    public function getDroitCompte() 
    {
        
        // 
        $query = getPdo()->prepare('SELECT FK_id_droit FROM compte
        WHERE id_compte = :id_compte');
        
        $query->execute(['id_compte' => $_SESSION['id_compte'] ]);  

        $i = 0;

        while ($row = $query->fetch()) {
            $statut[$i++] = $row['FK_id_droit'];
        }

        return $statut;
    }

        /**
     * Update un Droit à une personne donnée
     *
     * @param string $pseudo : Pseudo de la personne à update en droits
     * @param string $statut : Modérateur, Administrateur, Super-administrateur
     */
    public function banHammer(string $pseudo)
    {

        $queryId_compte = getPdo()->prepare('SELECT id_compte FROM compte 
        WHERE pseudo = :pseudo LIMIT 1');

        $queryId_compte->execute([
            'pseudo' => $pseudo
        ]);   

        $Id_compte = $queryId_compte->fetch();

        $query = getPdo()->prepare('UPDATE compte 
        SET estBanni = (CASE 
            WHEN estBanni = 0 THEN estBanni + 1 
            WHEN estBanni = 1 THEN estBanni - 1 
            ELSE estBanni 
            END) 
        WHERE id_compte = :id_compte');

        $query->execute([
        'id_compte' => $Id_compte['id_compte']
        ]);
        
    }

}

