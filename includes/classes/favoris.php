<?php

/**
 * Cette classe va nous permettre de gérer les favoris
 * d'update le statut de celui-ci 
 */

class favoris
{
    /**
     * Informations sur les favoris
     *
     * @var array
     */
    public $favoris = [];



    public function getFavoris()
    {
        

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
        $result = getPdo()->prepare('SELECT * FROM favoris');
        $result->execute();
        $query = getPdo()->prepare('UPDATE favoris
            SET favoris = (CASE 
            WHEN favoris = 0 THEN favoris + 1 
            WHEN favoris = 1 THEN favoris - 1 
            ELSE favoris 
            END)');
        

        $query->execute();
    }
}
