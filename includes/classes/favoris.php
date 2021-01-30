<?php

/**
 * Cette classe va nous permettre de gérer la connexion d'un membre,
 * de vérifier la session et les cookies et enfin
 * d'accéder aux informations du membre courant.
 */

class favoris
{
    /**
     * Informations sur le membre connecté
     *
     * @var array
     */
    public $favoris = [];



    public function getFavoris()
    {
        // Aucune erreur dans notre formulaire,
        // on crée le membre en BDD

        // Attempt select query execution

        $result = getPdo()->prepare('SELECT * FROM favoris');
        $result->execute();

        echo "<table>";
        echo "<tr>";
        echo "<th>UUID</th>";
        echo "<th>id_post</th>";
        echo "<th>id_membre</th>";
        echo "<th>favoris</th>";
        echo "<th>plus_tard</th>";
        echo "</tr>";
        while ($row = $result->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['UUID'] . "</td>";
            echo "<td>" . $row['id_post'] . "</td>";
            echo "<td>" . $row['id_membre'] . "</td>";
            echo "<td>" . $row['favoris'] . "</td>";
            echo "<td>" . $row['plus_tard'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }


    public function updateFavoris()
    {
        // $result = getPdo()->prepare('SELECT * FROM favoris');
        // $result->execute();
        // while ($row = $result->fetch()) {
        //     if ($row['favoris'] === false || null) {
        //         $query = getPdo()->prepare('UPDATE favoris
        // SET id_post = :id_post, id_membre = :id_membre, favoris = FALSE, plus_tard = :plus_tard
        // WHERE UUID = :UUID');
        //     }
        //     return ($query);
        // }
        $query = getPdo()->prepare('UPDATE favoris
        SET id_post = :id_post, id_membre = :id_membre, favoris = FALSE, plus_tard = :plus_tard
        WHERE UUID = :UUID');
        
        $query->execute([
            'UUID' => 1,
            'id_post' => 1,
            'id_membre' => 3,
            'favoris' => "false",
            'plus_tard' => "false"
        ]);
    }
}
