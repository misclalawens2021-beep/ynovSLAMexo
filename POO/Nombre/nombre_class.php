<?php
class Nombre {
	private $nb; // nombre entier

	public function __construct(){
		$this->nb = 0;
	}

	public function saisir($tab){
		$this->nb = (int) $tab['nb'];
	}

	public function afficher(){
		return "<br> Votre nombre : " . $this->nb;
	}

	public function mesDiviseurs(){
		$message = "<br>Les diviseurs sont : ";
		for ($div = 1; $div <= $this->nb; $div++){
			if ($this->nb % $div == 0){
				$message .= $div . ", ";
			}
		}
		return $message;
	}

	public function maTable (){
		//table multiplication 1-10
		$message = "<br> Table multiplication : ";
		for($i=1; $i<=10; $i++){
			$message .= $i . "*" . $this->nb . " = " . $i * $this->nb . "<br>";
		}
		return $message;
	}

	public function factoriel(){
		//n! = 1*2*3*4*...*n
		$message = "<br> Nombre factoriel : ";
		$f = 1;
		for ($i = 1; $i <= $this->nb; $i++){
			$f = $i * $f;
		}
		$message .= $f;
		return $message;
	}

	public function fibonacci (){
		$message = "<br> Le nb fibonacci : ";
		$a = 0; // f(0)
		$b = 1; // f(1)
		$c = $a;

		if ($this->nb == 0) {
			$c = $a;
		} elseif ($this->nb == 1) {
			$c = $b;
		} else {
			for($i = 2; $i<=$this->nb; $i++){
				$c = $a + $b;
				$a = $b;
				$b = $c;
			}
		}
		$message .= $c;
		return $message;
	}
}