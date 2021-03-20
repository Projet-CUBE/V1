<?php

/**
 * Cette classe va nous permettre de gérer la connexion d'un membre,
 * de vérifier la session et les cookies et enfin
 * d'accéder aux informations du membre courant.
 */

 class categorie
{
    public function insertCategorie()
    {
        //
        $query = getPdo()->prepare('INSERT INTO categorie (nom) 
                                     VALUES (:nom)');
        
        $query->execute([
            'nom' => "categorie 1"
        ]);
    }

    public function selectCategorie()
    {
        //
        $query = getPdo()->prepare('SELECT * FROM categorie');
        
        $query->execute();    

        $i = 0;

        while ($row = $query->fetch()) {
            $statut[$i++] = $row;
            var_dump($row);
        }

        return $statut;
    }

    public function updateCategorie()
    {
        $query = getPdo()->prepare('UPDATE categorie 
        SET nom = :nom
        WHERE id_categorie = :id_categorie');

        $query->execute([
        'nom' => "Update categorie",
        'id_categorie' => 1
        ]);
    }

    public function deleteCategorie()
    {
        $query = getPdo()->prepare('DELETE FROM categorie 
        WHERE id_categorie = :id_categorie');

        $query->execute([
        'id_categorie' => 3
        ]);
    }
}