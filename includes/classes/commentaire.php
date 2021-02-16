<?php

/**
 * Cette classe va nous permettre de gérer la connexion d'un membre,
 * de vérifier la session et les cookies et enfin
 * d'accéder aux informations du membre courant.
 */

 class commentaire
{
    public function getPoste(int $id_Post)
    {
        $result = getPdo()->prepare('SELECT * FROM post
        WHERE UUID_post = :UUID_post');
        $result->execute([
            'UUID_post' => $id_Post
        ]);

        while ($row = $result->fetch()) {

        $UUID_post = $row['UUID_post'];
        // Utilisation de this-> Sinon Uncaught error
        $pseudo = $this->pseudo((int)$UUID_post); 

        print '<div class="card mb-3">';
            print '<img class="card-img-top" src="../upload/'.$row['image'].'" alt="Card image cap">';
            print '<div class="card-body">';
                print '<h5 class="card-title">' . 
                $pseudo['pseudo'] 
                . '</h5>';
                print '<p class="card-text">' . $row['contenu'] . '.</p>';
            print '</div>';
        print '</div>';
        }
    }

    public function pseudo(int $id_membre) : array
    {
        $query = getPdo()->prepare('SELECT pseudo FROM compte
        INNER JOIN post 
        ON compte.id_compte = post.FK_id_membre 
        WHERE compte.id_compte = "' . $id_membre . '"
        LIMIT 1');

        $query->execute();

        return $query->fetch();
    }

    public function getCommentaires(int $id_Post)
    {
        $result = getPdo()->prepare('SELECT * FROM commentaire
        WHERE id_post = :id_post');
        $result->execute([
            'id_post' => $id_Post
        ]);

        while ($row = $result->fetch()) {

        print '<div class="card-body">';
            print '<h5 class="card-title">' . $row['auteur'] . '</h5>';
            print '<p class="card-text">' . $row['commentaire'] . '</p>';
        print '</div>';
        }

    }

    public function insertCommentaire(int $_id_Post, string $_pseudo)
    {
        //
        $query = getPdo()->prepare('INSERT INTO commentaire (id_post, commentaire, auteur, date_commentaire)
                                    VALUES ( (SELECT UUID_post FROM post WHERE UUID_post = :_id_Post), :commentaire, :auteur, NOW())');

        $query->execute([
            '_id_Post' => $_id_Post,
            'commentaire' => "Commentaire",
            'auteur' => $_pseudo
        ]);
    }
}