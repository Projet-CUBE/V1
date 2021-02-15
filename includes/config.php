<?php

return [
    // Configuration de la base de données
    'db_host' => 'localhost',
    'db_name' => 'cube',
    'db_user' => 'root',
    'db_pass' => '',
    'db_port' => 3306,

    // Configuration des pages
    'default_page' => 'connexion',
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
            'protected' => true,
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
        '404' => [
            'file' => '404.php',
            'title' => 'Page introuvable',
            'protected' => false,
        ]
    ]
];