<?php

class Etudiant {
    private $numCarte, $nom, $prenom; 
    private $montant, $statut;

    public function __construct(){
        $this->numCarte = 0;
        $this->nom = "";
        $this->prenom = "";
        $this->statut = "";
        $this->montant = 0; 
    }

    public function saisir($tab){
        $this->numCarte = $tab['numCarte'];
        $this->nom = $tab['nom'];
        $this->prenom = $tab['prenom'];
        $this->statut = $tab['statut'];
        $this->montant = $tab['montant']; 
    }

    public function afficher(){
        return "<tr>
                <td>" .$this->numCarte."</td>
                <td>" .$this->nom . "</td>
                <td>" .$this->prenom . "</td>
                <td>" .$this->statut ."</td>
                <td>" .$this->montant ."</td>
                </tr>";
    }

    // Getters & setters

    public function getNumCarte(){
        return $this->numCarte;
    }
    public function setNumCarte($numCarte){
        $this->numCarte = $numCarte;
    }

    public function getNom(){
        return $this->nom; 
    }
    public function setNom($nom){
        $this->nom = $nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }
    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function getStatut(){
        return $this->statut;
    }
    public function setStatut($statut){
        $this->statut = $statut;
    }

    public function getMontant(){
        return $this->montant;
    }
    public function setMontant($montant){
        $this->montant = $montant;
    }
}

?>