<?php

/**
 * Cette classe va nous permettre de gérer la connexion d'un membre,
 * de vérifier la session et les cookies et enfin
 * d'accéder aux informations du membre courant.
 */

 class commentaire
{
    public function getCommentaire()
    {

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