<?php
    class Modelo {
        public $idmodelo;
        public $descmodelo;


        function __construct($idmodelo, $descmodelo){
            $this->idmodelo = $idmodelo;
            $this->descmodelo = $descmodelo;

        }
    }
?>