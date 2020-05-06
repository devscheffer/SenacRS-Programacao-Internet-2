<?php
    class Carro {
        public $Chassi;
        public $Modelo;
        public $Versao;
        public $Cor;

        function __construct($Chassi, $Modelo, $Versao,$Cor){
            $this->Chassi = $Chassi;
            $this->Modelo = $Modelo;
            $this->Versao = $Versao;
            $this->Cor = $Cor;
        }
    }
?>