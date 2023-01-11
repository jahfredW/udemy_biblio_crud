<?php

// Ici l'index sert de routeur.
// Permet de faire l'association entre les demandes de l'utilisateur
// et la logique du site. 
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . 
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

// 1 - récupération du contrôleur de vue
require_once "controllers/livres.controller.php";

// 2 - instanciation du contrôleur
$livreController = new LivresController();

try{
    if(empty($_GET['page'])){
        require "views/accueil.view.php";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        switch($url[0]){
            case "livres": 
                // 3 - J'appelle la méthode afficherLivres du livreController.
                if(empty($url[1])){
                    $livreController->afficherLivres();
                } elseif($url[1] === "l"){
                    $livreController->afficherLivre($url[2]);
                } elseif($url[1] === "a"){
                    $livreController->ajouterLivre();
                } elseif($url[1] === "m"){
                    echo "modifier un livre";
                } elseif($url[1] === "s"){
                    $livreController->supprimerLivre($url[2]);
                } elseif($url[1] === "av"){
                    $livreController->ajoutLivreValidation();
                    echo "validation d'ajout d'un livre";
                }
                
                
                else {
                    throw new Exception("La page n'existe pas");
                }
                break;
            case "accueil":
                require "views/accueil.view.php";
                break;
            default: throw new Exception("La page n'existe pas");
        }
    }
} catch(Exception $e){
    echo $e->getMessage();
}





