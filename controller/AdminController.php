<?php


class AdminController extends Controller
{
    private $auth_levels = [
        "GUEST" => 0,
        "CONNECTÉ" => 1,
        "ADMIN" => 2
    ];
    
    // Méthode de filtrage
    private function filterAndGetUser($minAuthLevel = 1)
    {
        $compteModele = $this->loadModel("Compte");
        $redirectURL = "/auth/login";

        if (isset($_SESSION["identifiant"], $_SESSION["hash"], $_SESSION["type"], $_SESSION["ippref"])) {
            $ip = IP::getUserIP();
            $accountType = $_SESSION["type"];

            $validUser = $compteModele->userExists(Security::hardEscape($_SESSION["identifiant"]));
            $validIP = IP::startsWithPrefix($ip, Security::hardEscape($_SESSION["ippref"]));

            if (isset($this->auth_levels["$accountType"])) {
                $validAuthorization = $this->auth_levels["$accountType"] >= $minAuthLevel;
            } else {
                $validAuthorization = false;
            }

            if (!($validUser && $validIP && $validAuthorization)) {
                Session::destruct();
                $this->redirect($redirectURL);
            }
        } else {
            Session::destruct();
            $this->redirect($redirectURL);
        }

        $d["c_user"] = $compteModele->getByLogin($_SESSION["identifiant"], $_SESSION["hash"], true);
        $this->set($d);

        return $d["c_user"];
    }

    function listeCompte()
    {
        $this->filterAndGetUser(1);

        $this->modMembre = $this->loadModel("Membre");

        $groupby = "membre.id_membre";

        $d["membre"] = $this->modMembre->find([
            "groupby" => $groupby,
            "orderby" => "id_membre"
        ]);

        if (empty($d['membre'])) {
            $this->e404('Page introuvable');
        }

        $this->set($d);
        $this->render("other/listOther");
    }

   
 

    // public function listeUtilisateur()
    // {
    //     $this->filterAndGetUser(2);

    //     $compteModele = $this->loadModel("Compte");

    //     $users = $compteModele->find([
    //         "orderby" => "compte.identifiant"
    //     ], "TAB");

    //     $this->set(["users" => $users]);

    //     $this->render("listeUtilisateur");
    // }

    
    // public function deleteUtilisateur($id)
    // {
    //     $c_user = $this->filterAndGetUser(2);

    //     $compteModele = $this->loadModel("Compte");

    //     $user = $compteModele->find([
    //         "conditions" => ["idCompte" => $id]
    //     ], "TAB");

    //     if (!$user) {
    //         $this->e404("Cet utilisateur n'existe pas.");
    //     } elseif ($user[0]["idCompte"] === $c_user["idCompte"]) {
    //         $this->e404("Vous ne pouvez pas supprimer votre propre compte.");
    //     }

    //     $user = $user[0];

    //     $this->set(["user" => $user]);

    //     if (isset($_POST["passwd"])) {
    //         $password = Security::hardEscape($_POST["passwd"]);

    //         $validUser = $compteModele->getByLogin($_SESSION["identifiant"], $password);

    //         if (!$validUser) {
    //             $this->set(["info" => "Mot de passe incorrect."]);
    //         } else {
    //             // Suppression de l'utilisateur

    //             $arbitreModele = $this->loadModel("Arbitre");

    //             $arbitreModele->delete([
    //                 "conditions" => ["idArbitre" => $id]
    //             ]);
    //             $compteModele->delete([
    //                 "conditions" => ["idCompte" => $id]
    //             ]);

    //             $this->redirect("/admin/listeUtilisateur");
    //         }
    //     }
    // }

    // public function deletePersonne($id)
    // {
    //     $c_user = $this->filterAndGetUser(2);

    //     $personneModele = $this->loadModel("Personne");
    //     $compteModele = $this->loadModel("Compte");

    //     $personne = $personneModele->find([
    //         "conditions" => ["idPersonne" => $id]
    //     ], "TAB");

    //     if (!$personne) {
    //         $this->e404("Cette personne n'existe pas.");
    //     } elseif ($personne[0]["idPersonne"] === $c_user["idCompte"]) {
    //         $this->e404("Vous ne pouvez pas vous supprimer vous-même.");
    //     }

    //     $personne = $personne[0];

    //     $this->set(["personne" => $personne]);

    //     if (isset($_POST["passwd"])) {
    //         $password = Security::hardEscape($_POST["passwd"]);

    //         $validUser = $compteModele->getByLogin($_SESSION["identifiant"], $password);

    //         if (!$validUser) {
    //             $this->set(["info" => "Mot de passe incorrect."]);
    //         } else {
    //             // Suppression de la personne

    //             $arbitreModele = $this->loadModel("Arbitre");

    //             $arbitreModele->delete([
    //                 "conditions" => ["idArbitre" => $id]
    //             ]);
    //             $compteModele->delete([
    //                 "conditions" => ["idCompte" => $id]
    //             ]);
    //             $personneModele->delete([
    //                 "conditions" => ["idPersonne" => $id]
    //             ]);

    //             $this->redirect("/admin/listePersonne");
    //         }
    //     }
    // }

    // public function formUtilisateur($id)
    // {
    //     $c_user = $this->filterAndGetUser(1);

    //     $redirectURL = $c_user["typeCompte"] === "GÉRANT" ? "/admin/listeUtilisateur" : "/admin/listeChampionnat";

    //     $personneModele = $this->loadModel("Personne");
    //     $compteModele = $this->loadModel("Compte");
    //     $arbitreModele = $this->loadModel("Arbitre");

    //     $comptes = $compteModele->find([], "TAB");

    //     $personnes = $personneModele->find([
    //         "orderby" => "personne.prenom ASC"
    //     ], "TAB");

    //     $newForm = !isset($id);
    //     $types = Parser::getEnumValuesFromRaw($compteModele->getColumnFromTable("compte", "typeCompte")["Type"]);

    //     $filteredPersonnes = [];

    //     foreach ($personnes as $p) {
    //         $alreadyHasAnAccount = false;
    //         foreach ($comptes as $c) {
    //             if ($p["idPersonne"] === $c["idCompte"]) {
    //                 if (!(!$newForm && ($id === $p["idPersonne"]))) $alreadyHasAnAccount = true;
    //             }
    //         }
    //         if (!$alreadyHasAnAccount) array_push($filteredPersonnes, $p);
    //     }

    //     $d["newForm"] = $newForm;
    //     $d["types"] = $types;
    //     $d["personnes"] = $filteredPersonnes;
    //     $d["userId"] = $id;

    //     if ($newForm) {
    //         // Nouvel utilisateur
    //         $this->filterAndGetUser(2);

    //         if (isset($_POST["identifiant"], $_POST["password"], $_POST["typeCompte"], $_POST["idPersonne"])) {
    //             $identifiant = mb_strtolower(Security::shorten(Security::hardEscape($_POST["identifiant"]), 32));
    //             $password = Security::shorten($_POST["password"], 72);

    //             if (preg_match("/\W+/", $password))
    //                 $this->redirect($redirectURL);

    //             $typeCompte = $_POST["typeCompte"];
    //             $idPersonne = $_POST["idPersonne"];

    //             $compteModele->insert(
    //                 ["idCompte", "identifiant", "password", "typeCompte"],
    //                 [$idPersonne, $identifiant, Security::hash($password), $typeCompte]
    //             );

    //             if ($typeCompte === "ARBITRE") {
    //                 // Création d'une occurrence Arbitre
    //                 $arbitreModele->insert(["idArbitre"], [$idPersonne]);
    //             }

    //             $this->redirect($redirectURL);
    //         }
    //     } else {
    //         // Mise à jour d'un utilisateur

    //         if (($c_user["idCompte"] !== $id) && ($c_user["typeCompte"] !== "GÉRANT")) {
    //             $this->filterAndGetUser(2);
    //         }

    //         if (isset($_POST["identifiant"], $_POST["typeCompte"], $_POST["idPersonne"])) {
    //             $identifiant = mb_strtolower(Security::shorten(Security::hardEscape($_POST["identifiant"]), 32));
    //             $password = (isset($_POST["password"]) && strlen($_POST["password"]) > 0) ? Security::shorten($_POST["password"], 72) : "";
    //             $hash = $password ? Security::hash($password) : "";
    //             $typeCompte = $_POST["typeCompte"];
    //             $idPersonne = $_POST["idPersonne"];

    //             $donneesCompte = [
    //                 "idCompte" => $idPersonne,
    //                 "identifiant" => $identifiant,
    //                 "typeCompte" => $typeCompte
    //             ];

    //             if ($password) {
    //                 if (preg_match("/\W+/", $password)) {
    //                     $this->redirect($redirectURL);
    //                 } else
    //                     $donneesCompte["password"] = $hash;
    //             }

    //             if ($typeCompte === "ARBITRE" && $idPersonne !== $id) {
    //                 $arbitreModele->update([
    //                     "donnees" => [
    //                         "idArbitre" => $idPersonne
    //                     ],
    //                     "conditions" => [
    //                         "idArbitre" => $id
    //                     ]
    //                 ]);
    //             } else {
    //                 $arbitreModele->delete([
    //                     "conditions" => ["idArbitre" => $id]
    //                 ]);
    //             }

    //             $compteModele->update([
    //                 "donnees" => $donneesCompte,
    //                 "conditions" => [
    //                     "idCompte" => $id
    //                 ]
    //             ]);

    //             if ($c_user["idCompte"] === $id) {
    //                 Session::set("identifiant", $identifiant);
    //                 if ($password) {
    //                     Session::set("hash", $hash);
    //                 }
    //             }

    //             $this->redirect($redirectURL);
    //         }

    //         $user = $compteModele->find([
    //             "conditions" => ["idCompte" => $id]
    //         ], "TAB");

    //         if (!$user)
    //             $this->e404("Cet utilisateur n'existe pas.");
    //         elseif (!$personnes)
    //             $this->e404("Il n'existe aucune personne dans la base de données.");

    //         $d["user"] = $user[0];
    //     }

    //     $this->set($d);

    //     $this->render("formUtilisateur");
    // }

    // public function formPersonne($id)
    // {
    //     $this->filterAndGetUser(2);

    //     // Limites possible de l'âge
    //     $ageBounds = [15, 150];

    //     $redirectURL = "/admin/listePersonne";

    //     $personneModele = $this->loadModel("Personne");

    //     $newForm = !isset($id);

    //     $d["c_user"] = $newForm;
    //     $d["newForm"] = $newForm;
    //     $d["ageBounds"] = $ageBounds;

    //     $isAllSet = isset($_POST["nom"], $_POST["prenom"], $_POST["age"], $_POST["sexe"], $_POST["mail"], $_POST["adresse"]);


    //     if ($isAllSet) {

    //         $nom = Security::shorten(Security::hardEscape($_POST["nom"]), 64);
    //         $prenom = Security::shorten(Security::hardEscape($_POST["prenom"]), 64);
    //         $age = $_POST["age"];
    //         $sexe = $_POST["sexe"];
    //         $mail = filter_var(Security::shorten(Security::hardEscape($_POST["mail"]), 64), FILTER_VALIDATE_EMAIL);
    //         $adresse = Security::shorten(Security::hardEscape($_POST["adresse"]), 128);

    //         // L'adresse e-mail doit être valide.
    //         if (!$mail)
    //             $this->redirect($redirectURL);

    //         // L'âge doit être compris entre 15 et 150 (inclus).
    //         if (!Security::valueIsBetween($age, $ageBounds[0], $ageBounds[1]) || !is_numeric($age))
    //             $this->redirect($redirectURL);
    //     }

    //     if ($newForm) {
    //         // Nouvelle personne

    //         if ($isAllSet) {
    //             $personneModele->insert(
    //                 ["nom", "prenom", "age", "sexe", "mail", "adresse"],
    //                 [$nom, $prenom, $age, $sexe, $mail, $adresse]
    //             );

    //             $this->redirect($redirectURL);
    //         }
    //     } else {
    //         // Mise à jour d'une personne

    //         if ($isAllSet) {
    //             $personneModele->update([
    //                 "donnees" => [
    //                     "nom" => $nom,
    //                     "prenom" => $prenom,
    //                     "age" => $age,
    //                     "sexe" => $sexe,
    //                     "mail" => $mail,
    //                     "adresse" => $adresse
    //                 ],
    //                 "conditions" => [
    //                     "idPersonne" => $id
    //                 ]
    //             ]);

    //             $this->redirect($redirectURL);
    //         }

    //         $personne = $personneModele->find([
    //             "conditions" => ["idPersonne" => $id]
    //         ], "TAB");

    //         if (!$personne)
    //             $this->e404("Cet utilisateur n'existe pas.");

    //         $d["personne"] = $personne[0];
    //     }

    //     $this->set($d);

    //     $this->render("formPersonne");
    // }
}