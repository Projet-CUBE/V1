<?php

/**
 * Cette classe va nous permettre de gérer la connexion d'un membre,
 * de vérifier la session et les cookies et enfin
 * d'accéder aux informations du membre courant.
 */

 class post
{
    /**
     * Informations sur le membre connecté
     *
     * @var array
     */
    public $post = [];

    public function getPosts()
    {
        // Aucune erreur dans notre formulaire,
        // on crée le membre en BDD
                
        // Attempt select query execution

        $result = getPdo()->prepare('SELECT * FROM post');
        $result->execute();
        
        echo "<table>";
            echo "<tr>";
                echo "<th>UUID_Post</th>";
                echo "<th>titre</th>";
                echo "<th>sous_titre</th>";
                echo "<th>contenu</th>";
                echo "<th>publie</th>";
                echo "<th>date_publication</th>";
                echo "<th>date_derniere_modification</th>";
                echo "<th>label</th>";
            echo "</tr>";
        while($row = $result->fetch() )
        {
            echo "<tr>";
                echo "<td>" . $row['UUID_post'] . "</td>";
                echo "<td>" . $row['titre'] . "</td>";
                echo "<td>" . $row['sous_titre'] . "</td>";
                echo "<td>" . $row['contenu'] . "</td>";
                echo "<td>" . $row['publie'] . "</td>";
                echo "<td>" . $row['date_publication'] . "</td>";
                echo "<td>" . $row['date_derniere_modification'] . "</td>";
                echo "<td>" . $row['label'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
