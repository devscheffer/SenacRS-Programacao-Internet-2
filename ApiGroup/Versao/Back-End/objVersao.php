<?php
    class Versao {
        public $idversao;
        public $idmodelo;
        public $descversao;


        function __construct($idversao, $idmodelo, $descversao){
            $this->idversao = $idversao;
            $this->idmodelo = $idmodelo;
            $this->descversao = $descversao;

        }
    }
?>