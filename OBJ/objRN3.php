<?php
    class RN3 {
        public $Concessionaria;
        public $Ano;
        public $Mes;
        public $DistLucro;


        function __construct($Concessionaria, $Ano, $Mes,$DistLucro){
            $this->Concessionaria = $Concessionaria;
            $this->Ano = $Ano;
            $this->Mes = $Mes;
            $this->DistLucro = $DistLucro;
        }
    }
?>