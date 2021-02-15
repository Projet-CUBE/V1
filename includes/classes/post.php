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
        while ($row = $result->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['UUID_post'] . "</td>";
            echo "<td>" . $row['titre'] . "</td>";
            echo "<td>" . $row['sous_titre'] . "</td>";
            echo "<td>" . $row['contenu'] . "</td>";
            echo "<td>" . $row['publie'] . "</td>";
            echo "<td>" . $row['date_publication'] . "</td>";
            echo "<td>" . $row['date_derniere_modification'] . "</td>";
            echo "<td>" . $row['label'] . "</td>";


            // https://stackoverflow.com/questions/10526475/how-to-get-row-id-in-button-click
            
            $UUID_post = $row['UUID_post'];

            print "<td>" . '<form action="index.php?page=commentaire" method="post"> 
            <input name="commentaire" type="hidden" value="'. $UUID_post . '" /> 
            <input type="submit" value="Commentaire" /> 
            </form>' . "</td>";

            print "<td>" . '<form action="index.php?page=update" method="post"> 
            <input name="update" type="hidden" value="'. $UUID_post . '" />  
            <input type="submit" value="Update" /> 
            </form>' . "</td>";

            print "<td>" . '<form action="index.php?page=delete" method="post">  
            <input name="delete" type="hidden" value="'. $UUID_post . '" /> 
            <input type="submit" value="Delete" /> 
            </form>' . "</td>";

            echo "</tr>";
        }
        echo "</table>";
    }

    
    public function getPostsCard()
    {
        // Aucune erreur dans notre formulaire,
        // on crée le membre en BDD

        // Attempt select query execution

        $result = getPdo()->prepare('SELECT * FROM post');
        $result->execute();

        while ($row = $result->fetch()) {

            // https://stackoverflow.com/questions/10526475/how-to-get-row-id-in-button-click
            
            $UUID_post = $row['UUID_post'];
            
                print '<div class="row">';
                    print '<div class="col-sm-6">';
                        print '<div class="card">';
                        print '<img class="card-img-top" src="..." alt="Card image cap">';
                                print '<div class="card-body">';
                                    print '<h5 class="card-title">' . $row['titre']. '</h5>';
                                    print '<p class="card-text">' . $row['contenu'] . '</p>';

                                    print '<div class="card-body">';

                                        print '<form action="index.php?page=commentaire" method="post"> 
                                        <input name="commentaire" type="hidden" value="'. $UUID_post . '" /> 
                                        <input type="submit" value="Commentaire" /> 
                                        </form>';
                            
                                        print '<form action="index.php?page=update" method="post"> 
                                        <input name="update" type="hidden" value="'. $UUID_post . '" />  
                                        <input type="submit" value="Update" /> 
                                        </form>';
                            
                                        print '<form action="index.php?page=delete" method="post">  
                                        <input name="delete" type="hidden" value="'. $UUID_post . '" /> 
                                        <input type="submit" value="Delete" /> 
                                        </form>';
                                    print '</div>';
                                print '</div>';
                            print '</div>';
                        print '</div>';
                    print '</div>';
                print '</div>';
        }
    }


    public function insertPosts()
    {
        //
        $query = getPdo()->prepare('INSERT INTO post (titre, sous_titre, contenu, publie, date_publication, date_derniere_modification, label, FK_id_membre) 
                                     VALUES (:titre, :sous_titre, :contenu, :publie, NOW(), NOW(), :label, :FK_id_membre)');

        $query->execute([
            'titre' => "Test 1",
            'sous_titre' => "Hello World",
            'contenu' => "Lorem Ipsum",
            'publie' => 1,
            'label' => "Liorem",
            'FK_id_membre' => $_SESSION['id_compte']
        ]);
    }

    public function updatePosts()
    {

        $query = getPdo()->prepare('UPDATE post 
        SET titre = :titre, sous_titre = :sous_titre, contenu = :contenu, date_derniere_modification = NOW(), label = :label
        WHERE UUID_post = :UUID_post');

        $query->execute([
            'titre' => "Update",
            'sous_titre' => "Vello Porld",
            'contenu' => "Zorem Vpsum",
            'label' => "Uiorem",
            'UUID_post' => 3
        ]);
    }

    public function deletePosts()
    {

        $query = getPdo()->prepare('DELETE FROM post 
        WHERE UUID_post = :UUID_post');

        $query->execute([
            'UUID_post' => 3
        ]);
    }

}
