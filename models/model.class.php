<?php 

// class Model sous implémentée sous le pattern design sin  gleton
abstract class Model{
    // définition de l'attribut qui recevra l'instance de pdo
    private static $pdo;

    // configuration de la connexion à la bdd
    private static function setBdd(){
        // connexion
        self::$pdo = new PDO("mysql:host=localhost;dbname=biblio;charset=utf8", 'root', '');
        // parametre de co
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // fonction protégée
    protected function getBdd(){
        // si pdo n'est pas instanciée, on effectue la connexion
        if(self::$pdo === null){
            self::setBdd();
        }
        // on la renvoie
        return self::$pdo;
    }

}


?>