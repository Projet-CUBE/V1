<?php

/**
 * Donne un Droit à une personne donnée
 *
 * @param string $statut : Modérateur, Administrateur, Super-administrateur
 */
class droit
{
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
    public function updateCategorie(string $statut)
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