<?php
class Rectangle {
	// ATTRIBUTS
	private $lg, $lr;
	// CONSTRUCTEUR
	public function __construct(){
		// réinitialiser à 0
		$this -> lg = 0;
		$this -> lr = 0;
	}

	// METHODE
	public function saisir ($tab){
		$this -> lg = $tab['lg'];	// $_POST...
		$this -> lr = $tab['lr'];
	}
	public function afficher (){
		return "<br> La longueur est de : " . $this->lg; . "<br> La largeur est de : " . $this -> lr; 
	}
	public function surface () {
		$s = $this -> lg * $this -> lr;
		return $s;
	}
	public function perimetre() {
		$p = 2*($this->lg + $this->lr);
		return $p;
	}
	// GETTERS & SETTERS
	public function getLg(){
		return $this->lg;
	}
	public function setLg($lg){
		$this->lg = $lg;
	}
	public function getLr(){
		return $this->Lr;
	}
	public function setLr($lr){
		$this->$lr = $lr;
	}

}


?>