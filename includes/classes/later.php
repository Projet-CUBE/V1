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


    public function updateLater($UUID_post, $id_membre)
    {
        $result = getPdo()->prepare('SELECT * FROM favoris WHERE id_post=:id_post AND id_membre=:id_membre');
        $result->execute([
            'id_post' => $UUID_post,
            'id_membre' => $id_membre
        ]);
        $query = getPdo()->prepare('UPDATE favoris
        SET plus_tard = (CASE 
        WHEN plus_tard = 0 THEN plus_tard + 1 
        WHEN plus_tard = 1 THEN plus_tard - 1 
        ELSE plus_tard 
        END) WHERE id_post=:id_post AND id_membre=:id_membre');
        
        $query->execute([
            'id_post' => $UUID_post,
            'id_membre' => $id_membre
        ]);
    }
}
