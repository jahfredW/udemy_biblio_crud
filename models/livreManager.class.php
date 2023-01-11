<?php 

require_once "model.class.php";
require_once "livre.class.php";

class LivreManager extends Model{
    private $livres;

    public function ajoutLivre($livre){
        $this->livres[] = $livre;
    }

    public function getLivres(){
        return $this->livres;
    }

    public function chargementLivre(){
        // requete getAll préparée
        $sqlreq = "SELECT * FROM livres";
        $stmt = $this->getBdd()->prepare($sqlreq);
        $stmt->execute();
        $Meslivres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        // parcourir le tab qui conwtient toutes les datas de la bdd
        foreach($Meslivres as $livre){
            // plug les datas de la bdd dans des nouvels objets
            $l = new Livre($livre['id'], $livre['titre'], $livre['nbPages'], $livre['image']);
            // Et alimenter le tableau d'objets dans la foulée
            $this->ajoutLivre($l);
        }
    }

    public function getLivreById($id){
        if(empty($this->livres[$id - 1])){
            $sqlReq = "SELECT * FROM livres WHERE id = :id";
            $stmt = $this->getBdd()->prepare($sqlReq);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $monLivre = $stmt->fetchall(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
        } else{
            $monLivre = $this->livres[$id - 1];
        }
        return $monLivre;

    }

    public function ajoutLivreBd($titre, $nbPages, $image){
        $sqlReq = "INSERT INTO livres (titre, nbPages, image) values ( :titre, :nbPages, :image)";
        $stmt = $this->getBdd()->prepare($sqlReq);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":nbPages", $nbPages, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        try{
            $resultat = $stmt->execute(); 
        } catch (Exception $e){
            echo " erreur d'inscription en bdd";
            echo $e->getMessage();
        }
        $stmt->closeCursor();

        if($resultat > 0){
            $livre = new Livre($this->getBdd()->lastInsertId(), $titre, $nbPages, $image);
            $this->ajoutLivre($livre);
        }
    }

    public function supprimerLivreBdd($id){
        $sqlReq = "DELETE FROM livres WHERE id = :idLivre";
        $stmt = $this->getBdd()->prepare($sqlReq);
        $stmt->bindValue(":idLivre", $id);
        $stmt->execute();
        $stmt->closeCursor();
    }
}