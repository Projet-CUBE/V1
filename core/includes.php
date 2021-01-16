<?php

// Fichier de configuration

// Cœurs
require 'Router.php';
require 'Request.php';
require 'Dispatcher.php';
require 'Controller.php';
require 'Model.php';
require 'Session.php';

// Modèles
require_once ROOT . DS . 'model' . DS . 'Compte.php';
require_once ROOT . DS . 'model' . DS . 'Membre.php';

// Scripts
require_once ROOT . DS . 'scripts' . DS . 'ArrayWizard.php';
require_once ROOT . DS . 'scripts' . DS . 'IP.php';
require_once ROOT . DS . 'scripts' . DS . 'Parser.php';
require_once ROOT . DS . 'scripts' . DS . 'Security.php';


?>