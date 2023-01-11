<?php
// effectue l'action de pilotage

// Assure l'assemblage des morceaux, et fait les appels aux modeles et aux vues.

// effectue toutes les actions nécessaires pour renvoyer un résultat cohérent à l'utilisateur
// sur la deamnde de routage lors d'une demande spécifique via une url

// Le contrôleur permet de piloter la demande du client pour aller rechercher les données
// nécessaires et les transmettre à la vue. Il coordonne ce qui doit être mis en place 
// pour renvoyer le résultat. 
require_once "models/livreManager.class.php";

class LivresController{
    private $livreManager;

    // 4 - au moment de sa création, instancie un LivreManager
    // Et récupération de tous les livres. 
    public function __construct(){
        $this->livreManager = new LivreManager();
        $this->livreManager->chargementLivre();
    }

    // 5 - Les datas sont accessibles via l'attribut privé $livremanager
    // 6 - Action de récupérer tous les livres, que j'utilise dans ma vue. 
    public function afficherLivres(){
        $livres = $this->livreManager->getLivres();
        require "views/livres.view.php";
    }

    public function afficherLivre($id){
        $livre = $this->livreManager->getLivreById($id);
        require "views/afficherLivre.view.php";
    }

    public function ajouterLivre(){
        // require + path = renvoyer une vue. 
        require "views/ajouterLivre.view.php";
    }

    public function ajoutLivreValidation(){
        $file = $_FILES['image'];
        $repertoire = "public/images/";
        $nomImageAjoute = $this->ajoutImage($file, $repertoire);
        $this->livreManager->ajoutLivreBd($_POST['titre'], $_POST['nbPages'], $nomImageAjoute);
        header('Location: '. URL . "livres");
    }

    private function ajoutImage($file, $dir){
        if(!isset($file['name']) || empty($file['name'])){
            throw new Exception("Vous devez indiquer une image");
        }

        if(!file_exists($dir)){
            mkdir($dir, 0777);
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $random = rand(0,99999);
        $target_file = $dir.$random."_".$file['name'];

        // verification que le fichier est une image
        if(!getImagesize($file['tmp_name'])){
            throw new Exception("Le fichier n'est pas une image");
        }
        // vérification de l'extension
        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif"){
            throw new Exception("L'extension du fichier n'est pas connue");
        }
        // vérification de doublon
        if(file_exists($target_file)){
            throw new Exception("Le fichier existe déja");
        }
        // vérification de la taille de l'image
        if($file['size'] > 500000){
            throw new Exception("Le fichier est trop gros");
        }
        // vérification du bon fonctionnementde l'ajout de l'image dans le dossier
        if(!move_uploaded_file($file['tmp_name'], $target_file)){
            throw new Execption("L'ajout de l'image n'a pas fonctionné");
        }
        else {
            return ($random."_".$file['name']);
        }
    }

    function supprimerLivre($id){
        $nomImage = $this->livreManager->getLivreById($id)->getImage();
        unlink("public/images/".$nomImage);
        $this->livreManager->supprimerLivreBdd($id);
        header('Location: '. URL . "livres");
    }
}