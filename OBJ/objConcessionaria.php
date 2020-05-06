<?php
    class Concessionaria {
        public $IDConcessionaria;
        public $NomeFantasia;
        public $UF;
        public $Municipio;

        function __construct($IDConcessionaria, $NomeFantasia, $UF,$Municipio){
            $this->IDConcessionaria = $IDConcessionaria;
            $this->NomeFantasia = $NomeFantasia;
            $this->UF = $UF;
            $this->Municipio = $Municipio;
        }
    }
?>