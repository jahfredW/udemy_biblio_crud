<?php

class Livre{

    private int $id;
    private string $titre;
    private int $nbPages;
    private string $image;

    public function __construct($id, $titre, $nbPages, $image){
        $this->id = $id;
        $this->titre = $titre;
        $this->nbPages = $nbPages;
        $this->image = $image;
    }

    public function getId(){ return $this->id;}
    public function getTitre(){ return $this->titre;}
    public function getNbPages(){ return $this->nbPages;}
    public function getImage(){ return $this->image;}

    public function setId($value){ $this->id = $value;}
    public function setTitre($value){ $this->titre = $value;}
    public function setNbPages($value){ $this->nbPages = $value;}
    public function setImage($value){ $this->image = $value;}

    public static function getListeLivres(){
        return self::$listeLivres;
    }

}