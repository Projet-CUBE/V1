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



    public function getFavoris($UUID_post)
    {


        $result = getPdo()->prepare('SELECT * FROM favoris WHERE id_post=:id_post');
        $result->execute([
            'id_post' => $UUID_post
        ]);

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


    public function updateFavoris($UUID_post, $id_membre)
    {
        $result = getPdo()->prepare('SELECT * FROM favoris WHERE id_post=:id_post AND id_membre=:id_membre');
        $result->execute([
            'id_post' => $UUID_post,
            'id_membre' => $id_membre
        ]);
        $query = getPdo()->prepare('UPDATE favoris
            SET favoris = (CASE 
            WHEN favoris = 0 THEN favoris + 1 
            WHEN favoris = 1 THEN favoris - 1 
            ELSE favoris 
            END) WHERE id_post=:id_post  AND id_membre=:id_membre');

        $query->execute([
            'id_post' => $UUID_post,
            'id_membre' => $id_membre
        ]);
    }



    public function getFavorisIcon($UUID_post)
    {
        $result = getPdo()->prepare('SELECT * FROM favoris WHERE id_post=:id_post');
        $result->execute([
            'id_post' => $UUID_post
        ]);

        while ($row = $result->fetch()) {
            $fav_value = $row['favoris'];
            return $fav_value;
        }
    }
    public function getLaterIcon($UUID_post)
    {
        $result = getPdo()->prepare('SELECT * FROM favoris WHERE id_post=:id_post');
        $result->execute([
            'id_post' => $UUID_post
        ]);

        while ($row = $result->fetch()) {
            $fav_value = $row['plus_tard'];
            return $fav_value;
        }
    }
}
