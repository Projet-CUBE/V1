<?php

/**
 * Cette classe va nous permettre de gérer la connexion d'un membre,
 * de vérifier la session et les cookies et enfin
 * d'accéder aux informations du membre courant.
 */
class Member
{
    /**
     * Grain de sel utilisé pour la création d'un hash de sécurité aux cookies
     *
     * @var string
     */
    private static $salt = '16kXI#g<:<p<j}wF@8OBP$q[';

    /**
     * Le visiteur est connecté. Par défaut, non
     *
     * @var bool
     */
    private $logged = false;



    private $banned = 0;
    //isBanned?

    /**
     * Informations sur le membre connecté
     *
     * @var array
     */
    private $member = [];

    public function __construct()
    {
        // Tente de récupérer le membre par la SESSION
        $this->getFromSession();

        // Tente de récupérer le membre par les COOKIES
        $this->getFromCookie();
    }

    /**
     * Méthode permettant de vérifier si un membre est bani
     *
     * @param 
     * @return 
     */
    public function setBan()
    {
        $query = getPdo()->prepare('UPDATE compte
            SET compte = (CASE 
            WHEN estBanni = 0 THEN estBanni + 1 
            WHEN estBanni = 1 THEN estBanni - 1 
            ELSE estBanni 
            END)');
        $query->execute();
    }

    /**
     * Le visiteur est connecté ?
     *
     * @return bool
     */
    public function isLogged(): bool
    {
        return $this->logged;
    }


    public function isBanned($string){
        $query = getPdo()->prepare('SELECT * FROM compte WHERE pseudo = :pseudo LIMIT 1');
        $query->execute(['pseudo' => $string]);
        $result = $query->fetch();
        if ($result['estBanni'] === '1') {
            echo "<div class="."alert alert-error".">T'es banni.</div>";
        } 
    }

    /**
     * Récupére une information sur le membre connecté
     *
     * @param string $key La clé à récupérer. Ex : pseudo, email, ...
     * @return mixed|null La valeur de la clé ou NULL s'il elle n'existe pas
     */
    public function get(string $key)
    {
        if ($this->isLogged() && array_key_exists($key, $this->member)) {
            return $this->member[$key];
        }

        return null;
    }

    /**
     * Méthode statique permettant de vérifier si un pseudo est déjà utilisé
     *
     * @param string $pseudo Le pseudo à vérifier
     * @return bool
     */
    public static function pseudoIsAlreadyTaken(string $pseudo): bool
    {
        $query = getPdo()->prepare('SELECT * FROM compte WHERE pseudo = :pseudo LIMIT 1');
        $query->execute(['pseudo' => $pseudo]);

        return $query->fetch() !== false;
    }

    /**
     * Méthode statique permettant de vérifier si un email est déjà utilisé
     *
     * @param string $email L'email à vérifier
     * @return bool
     */
    public static function emailIsAlreadyTaken(string $email): bool
    {
        $query = getPdo()->prepare('SELECT * FROM compte WHERE email = :email LIMIT 1');
        $query->execute(['email' => $email]);

        return $query->fetch() !== false;
    }

    /**
     * Méthode statique permettant de créer une session depuis un
     * tableau d'information sur un membre
     *
     * @param array $infos
     */
    public static function createSession(array $infos): void
    {
        $_SESSION['id_compte'] = $infos['id_compte'];
        $_SESSION['pseudo'] = $infos['pseudo'];
    }

    /**
     * Méthode statique permettant de créer les cookies de connexion automatique
     * depuis un tableau d'information sur un membre
     *
     * @param array $infos
     */
    public static function createCookie(array $infos): void
    {
        // Expiration du cookie dans 30 jours
        $duration = 60 * 60 * 24 * 30;
        $expiration = time() + $duration;

        setcookie('member_id', $infos['id_compte'], $expiration, null, null, false, true);
        setcookie('member_hash', self::generateHash($infos), $expiration, null, null, false, true);
    }

    /**
     * Méthode statique qui à partir des infos d'un membre et d'un grain de sel
     * va générer un hash unique pour la connexion automatique par cookie.
     * Si le grain de sel change, les cookies précédemment créés ne
     * fonctionneront plus.
     *
     * @param array $infos
     * @return string
     */
    protected static function generateHash(array $infos): string
    {
        // Explication : https://www.php.net/manual/fr/function.sha1.php
        return hash("sha512", ($infos['id_compte'] . $infos['pseudo'] . self::$salt));
    }

    /**
     * Récupère un membre depuis ses infos de session
     */
    protected function getFromSession(): void
    {
        // Les variables de session existent
        if (! empty($_SESSION['id_compte']) && ! empty($_SESSION['pseudo'])) {
            $query = getPdo()->prepare('SELECT * FROM compte WHERE id_compte = :id_compte LIMIT 1');
            $success = $query->execute(['id_compte' => $_SESSION['id_compte']]);

            // Le membre existe en BDD
            if ($success) {
                $this->member = $query->fetch();
                $this->logged = true;
            }
        }
    }

    /**
     * Récupère un membre depuis les infos de cookie
     */
    protected function getFromCookie(): void
    {
        $id = $_COOKIE['member_id'] ?? null;
        $hash = $_COOKIE['member_hash'] ?? null;

        // L'ID et le Hash existent dans les cookies
        if (! empty($id) && ! empty($hash)) {
            $query = getPdo()->prepare('SELECT * FROM compte WHERE id_compte = :id_compte LIMIT 1');
            $success = $query->execute(['id_compte' => $id]);
            $member = $query->fetch();

            // Le membre existe en BDD et le hash fourni est valide
            if ($success && $hash === self::generateHash($member)) {
                $this->member = $member;
                $this->logged = true;
            }
        }
    }
}
