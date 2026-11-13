<?php
    class Tableau{
        //atttribut
        private $tab ;

        //constructeur
        public function __construct(){
            $this->tab = array();
        }

        //methodes
        public function saisir ($tab){
            $this -> tab = explode(";", $tab['tab']);
        }
        public function afficher (){
            $message = "<br> Tableau : [";
            // boucle concaténation
            foreach ($this->tab as $element) {
                $message .= $element . ", ";
            }
            $message .= "]";
            return $message;
        }
        public function moyenne (){
            $somme = 0;
            foreach ($this->tab as $element) {
                $somme += $element;
            }
            return ($somme /count($this->tab));
        }
        public function minMax (){
            $min = $this->tab[0];
            $max = $this->tab[0];

            foreach($this->tab as $element) {
                if ($element < $min){
                    $min = $element;
                }
                if($element > $max){
                    $max = $element;
                }
            }
            return "<br> Le minimum est de :".$min."<br> Le maximum est de :".$max;
        }


        public function trier (){
            for($i = 0; $i < count($this->tab) -1; $i++){
                for($j = $i+1; $j < count($this->tab) ; $j++){
                    if($this->tab[$i] > $this->tab[$j]){
                        $temp = $this->tab[$i];
                        $this->tab[$i] = $this->tab[$j];
                        $this->tab[$j] = $temp;
                    }
                }
            }
            return $this->afficher();
        }
        //getters and setters
        public function getTab(){
            return $this->tab;
        }
        public function setTab(){
            $this->tab = $tab;
        }
    }

?>