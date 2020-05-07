<?php
    class RN4 {
        public $IDVendedor;
        public $UF;
        public $Ano;
        public $Mes;


        function __construct($IDVendedor, $UF, $Ano,$Mes){
            $this->IDVendedor = $IDVendedor;
            $this->UF = $UF;
            $this->Ano = $Ano;
            $this->Mes = $Mes;
        }
    }
?>