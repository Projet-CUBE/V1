<?php

/**
 * Cette classe va nous permettre de gérer les favoris
 * d'update le statut de celui-ci 
 */

class later
{
    /**
     * Informations sur les à regarder à plus tard
     *
     * @var array
     */
    public $later = [];



    public function getLater()
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


    public function updateLater()
    {
        $result = getPdo()->prepare('SELECT * FROM favoris');
        $result->execute();
        $query = getPdo()->prepare('UPDATE favoris
        SET id_post=:id_post, id_membre=:id_membre, favoris=:favoris,
        plus_tard = (CASE 
        WHEN plus_tard = 0 THEN plus_tard + 1 
        WHEN plus_tard = 1 THEN plus_tard - 1 
        ELSE plus_tard 
        END)');

        while ($row = $result->fetch()) {
            bug($row);
            $query->execute([
                'id_post' => $row['id_post'],
                'id_membre' => $row['id_membre'],
                'favoris' => $row['favoris']
            ]);
        }
    }
}
