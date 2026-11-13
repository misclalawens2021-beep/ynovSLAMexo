<?php 
require_once("etudiant.class.php");

class Promotion {
    // Une promotion est composée de plusieurs étudiants

    private $lesEtudiants;

    public function __construct(){
        $this->lesEtudiants = array();
    }

    public function ajouterEtudiant($unEtudiant){
        $this->lesEtudiants[] = $unEtudiant;
    }

    public function listerEtudiants(){
        $chaine = "<table border = '1'>
        <tr>
            <td> Num carte </td>
            <td> Nom </td>
            <td> Prenom </td>
            <td> Statut </td>
            <td> Montant </td>
        </tr> ";

        foreach($this->lesEtudiants as $unEtudiant){
            $chaine .= $unEtudiant->afficher();    
        }
        $chaine .= "</table>";
        return $chaine;
    }

    public function moyenneMontants(){
    
        $sum = 0;

        // for($unMontant = 0; $unMontant<$this->montant)
        foreach($this->lesEtudiants as $unEtudiant){
            $sum += $unEtudiant->getMontant(); 
        }
        return ($sum / count($this->lesEtudiants));
    }
    public function getEtudiant($unStatut){
        /** Retourne un tableau contenant les étudiants
         * ayant un statut recu en entrée.*/
        $tabStatut = array();

        foreach($this->lesEtudiants as $unEtudiant) {
            if($unEtudiant->getStatut() == $unStatut){
                $tabStatut[] = $unEtudiant;
            }
        }
        return $tabStatut;
    }
}
