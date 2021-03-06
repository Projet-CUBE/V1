<?php
return [
    // Configuration de la base de données
    'db_host' => 'localhost',
    'db_name' => 'cube',
    'db_user' => 'root',
    'db_pass' => '',
    'db_port' => 3306,

    // Configuration des pages
    'default_page' => 'accueil',
    'pages' => [
        'connexion' => [
            'file' => 'connexion.php', // Fichier contenant la page
            'title' => 'Connexion', // Titre de la page pour la balise <title>
            'protected' => false, // Il faut être connecté pour accéder à la page
        ],
        'inscription' => [
            'file' => 'inscription.php',
            'title' => 'Inscription',
            'protected' => false,
        ],
        'deconnexion' => [
            'file' => 'deconnexion.php',
            'title' => null,
            'protected' => false,
        ],
        'profil' => [
            'file' => 'profil.php',
            'title' => 'Profil',
            'protected' => true,
        ],
        'accueil' => [
            'file' => 'accueil.php',
            'title' => 'Accueil',
            'protected' => false,
        ],
        'statistique' => [
            'file' => 'statistique.php',
            'title' => 'Statistique',
            'protected' => true,
        ],
        'gestion-comptes' => [
            'file' => 'gestion-comptes.php',
            'title' => 'Gestion des comptes',
            'protected' => true,
        ],
        'comptes-changer' => [
            'file' => 'comptes-changer.php',
            'title' => 'Comptes changé',
            'protected' => true,
        ],
        'evenements' => [
            'file' => 'evenements.php',
            'title' => 'Evènements',
            'protected' => true,
        ],
        'event' => [
            'file' => '/calendar/event.php',
            'title' => 'Event',
            'protected' => true,
        ],
        'add_event' => [
            'file' => '/calendar/add_event.php',
            'title' => 'Ajouter un évènement',
            'protected' => true,
        ],
        'edit_event' => [
            'file' => '/calendar/edit_event.php',
            'title' => 'Editer un évènement',
            'protected' => true,
        ],
        'commentaire' => [
            'file' => 'commentaire.php',
            'title' => 'Commentaire',
            'protected' => true,
        ],
        'insertPost' => [
            'file' => 'insertPost.php',
            'title' => 'Inserer un post',
            'protected' => true,
        ],   
        'updatePost' => [
            'file' => 'updatePost.php',
            'title' => 'Updater un post',
            'protected' => true,
        ],   
        'insertCommentaire' => [
            'file' => 'insertCommentaire.php',
            'title' => 'Inserer un commentaire',
            'protected' => true,
        ],     
        'insertCategories' => [
            'file' => 'insertCategories.php',
            'title' => 'Inserer un commentaire',
            'protected' => true,
        ],   
        'update' => [
            'file' => 'update.php',
            'title' => 'Update',
            'protected' => true,
        ],
        'delete' => [
            'file' => 'delete.php',
            'title' => 'Delete',
            'protected' => true,
        ],
        'download' => [
            'file' => 'download.php',
            'title' => 'Download',
            'protected' => true,
        ],
        'favoris' => [
            'file' => 'favoris.php',
            'title' => 'Favoris',
            'protected' => true,
        ],
        '404' => [
            'file' => '404.php',
            'title' => 'Page introuvable',
            'protected' => false,
        ]
    ]
];