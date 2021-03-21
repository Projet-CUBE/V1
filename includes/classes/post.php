<?php

/**
 * Cette classe va nous permettre de gérer la connexion d'un membre,
 * de vérifier la session et les cookies et enfin
 * d'accéder aux informations du membre courant.
 */

class post extends Member
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
            <input name="commentaire" type="hidden" value="' . $UUID_post . '" /> 
            <input type="submit" value="Commentaire" /> 
            </form>' . "</td>";

            print "<td>" . '<form action="index.php?page=update" method="post"> 
            <input name="update" type="hidden" value="' . $UUID_post . '" />  
            <input type="submit" value="Update" /> 
            </form>' . "</td>";

            print "<td>" . '<form action="index.php?page=delete" method="post">  
            <input name="delete" type="hidden" value="' . $UUID_post . '" /> 
            <input type="submit" value="Delete" /> 
            </form>' . "</td>";

            echo "</tr>";
        }
        echo "</table>";
    }

    public function getPostsCard($trie)
    {

        $member = new Member; //Variable member pour la vérification de connexion
        $favoris = new favoris(); // Variable favoris pour vérifier le tableau des favoris/later

        //Si déconnecté
        if (!$member->isLogged()) {

            $result = getPdo()->prepare('SELECT * FROM post WHERE public = 1');
            $result->execute();
        } elseif ($member->isLogged()) {

            $id_compte = (int)$_SESSION['id_compte'];
            $result = getPdo()->prepare('SELECT * FROM post p INNER JOIN compte c ON c.id_compte = p.FK_id_membre WHERE public = 1 OR private = 1 AND id_compte = :id_compte');
            $result->execute(['id_compte' => $id_compte]);

            
            if ($trie === 3) {
                
                $result = getPdo()->prepare('SELECT * FROM post p INNER JOIN compte c ON c.id_compte = p.FK_id_membre WHERE public = 1 OR private = 1 AND id_compte = :id_compte');
                $result->execute(['id_compte' => $id_compte]);
                
                }

            else if (isset($trie)) {
                $result = getPdo()->prepare('SELECT * FROM compte c 
                INNER JOIN post p ON c.id_compte = p.FK_id_membre
                INNER JOIN objet_categorie ob ON ob.FK_id_post = p.UUID_post
                INNER JOIN categorie cat ON cat.id_categorie = ob.FK_id_categorie
                WHERE ob.FK_id_categorie = :id_categorie');
                $result->execute([
                'id_categorie' => $trie]);
            }
            
        }


        // Aucune erreur dans notre formulaire,
        // on crée le membre en BDD

        // Attempt select query execution

        $i = 0;
        print '<form action="" method="post">';
        while ($row = $result->fetch()) {
            reset($_POST);
            // https://stackoverflow.com/questions/10526475/how-to-get-row-id-in-button-click

            $UUID_post = $row['UUID_post'];
            // Utilisation de this-> Sinon Uncaught error
            $pseudo = $this->pseudoo((int)$UUID_post);

            if (array_key_exists('btn_fav', $_POST)) {
                // $events->delete($event, $member);
                $favoris = new favoris();
                $favoris->updateFavoris($_POST['btn_fav'], $_SESSION['id_compte']);
                header('Location: index.php?page=accueil');
            }
            if (array_key_exists('btn_later', $_POST)) {
                // $events->delete($event, $member); 
                $later = new later();
                $later->updateLater($_POST['btn_later'], $_SESSION['id_compte']);
                header('Location: index.php?page=accueil');
            }
            $i++;

            if ($i === 1) {
                print '<div class="row">';
            }
            print '<div class="col-sm-6">';
            print '<div class="card">'; //Vérifier si le post est privé ou public
            if ($row['image']) {
                print '<img class="card-img-top" src="../upload/' . $row['image'] . '" alt="Card image cap">';
            }
            print '<div class="card-body">';
            print '<h5 class="card-title">' . $pseudo['pseudo'] . '</h5>';



            print '<p class="card-text">' . $row['contenu'] . '</p>';
            if ($member->isLogged()) {
                $favoris->getFavorisIcon($UUID_post) == 0 ?
                print '<button  name="btn_fav" value=' . $UUID_post . ' style="border:none;background-color:transparent;"><i class="bi bi-star"></i></button>' :
                print '<button name="btn_fav" value=' . $UUID_post . '  style="border:none;background-color:transparent;"><i class="bi bi-star-fill"></i></button>';
                $favoris->getLaterIcon($UUID_post) == 0 ?   
                print '<button name="btn_later" value=' . $UUID_post . ' style="border:none;background-color:transparent;"><i class="bi bi-clock"></i></button>':
                print '<button name="btn_later" value=' . $UUID_post . ' style="border:none;background-color:transparent;"><i class="bi bi-check-circle"></i></button>';
                
                print '<form action="index.php?page=commentaire" method="post"> 
                                        <input name="commentaire" type="hidden" value="' . $UUID_post . '" /> 
                                        <input type="submit" value="Commentaire" /> 
                                        </form>';

                if ($member->get('pseudo') == $pseudo['pseudo']) {
                    print '<form action="index.php?page=update" method="post"> 
                                            <input name="update" type="hidden" value="' . $UUID_post . '" />  
                                            <input type="submit" value="Update" /> 
                                            </form>';

                    print '<form action="index.php?page=delete" method="post">  
                                            <input name="delete" type="hidden" value="' . $UUID_post . '" /> 
                                            <input type="submit" value="Delete" /> 
                                            </form>';
                }
            }

            print '</div>';
            print '</div>';
            print '</div>';
        }
        print '</form>';
        print '</div>';
    }


    public function pseudoo(int $id_membre): array
    {
        $query = getPdo()->prepare('SELECT pseudo FROM compte
        INNER JOIN post 
        ON compte.id_compte = post.FK_id_membre 
        WHERE post.UUID_post = "' . $id_membre . '"
        LIMIT 1');

        $query->execute();

        return $query->fetch();
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

    public function updatePosts(int $_UUID_post, string $_contenu, string $_image_file, string $_name)
    {

        $query = getPdo()->prepare('UPDATE post 
        SET contenu = :contenu, date_derniere_modification = NOW(), image = :image, name_image = :name_image
        WHERE UUID_post = :UUID_post');

        $query->execute([
            'contenu' => $_contenu,
            'image' => $_image_file,
            'name_image' => $_name,
            'UUID_post'  => $_UUID_post
        ]);
    }

    public function deletePosts(int $_UUID_post)
    {

        // $comTrue = getPdo()->prepare('SELECT * FROM post p INNER JOIN commentaire c ON p.UUID_post = c.id_post WHERE c.commentaire IS NOT NULL');
        // $comTrue->execute();

        // var_dump($comTrue);
        // if($comTrue){

        //     //Requete suppression commentaire lié
        //     $com = getPdo()->prepare('DELETE c FROM commentaire c 
        //     INNER JOIN post p ON c.id_post = p.UUID_post 
        //     WHERE p.UUID_post = :UUID_post
        //     AND c.id_post = :UUID_post');
        //     $com->execute();

        //     //suppression du post
        //     $query = getPdo()->prepare('DELETE p FROM post p 
        //     INNER JOIN commentaire c ON p.UUID_post = c.id_post
        //     WHERE p.UUID_post = :UUID_post
        //     AND c.id_post = :UUID_post');

        //     $query->execute([
        //         'UUID_post' => $_UUID_post
        //     ]);

        // }else{

        $query = getPdo()->prepare('DELETE FROM post 
            WHERE UUID_post = :UUID_post');

        $query->execute([
            'UUID_post' => $_UUID_post
        ]);
    }
}
