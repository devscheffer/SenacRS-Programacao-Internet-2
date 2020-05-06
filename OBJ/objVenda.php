<?php
    class Venda {
        public $IDSale;
        public $Concessionaria;
        public $Vendedor;
        public $Chassi;
        public $Data;
        public $Valor;

        function __construct($IDSale, $Concessionaria, $Vendedor,$Chassi,$Data,$Valor){
            $this->IDSale = $IDSale;
            $this->Concessionaria = $Concessionaria;
            $this->Vendedor = $Vendedor;
            $this->Chassi = $Chassi;
            $this->Data = $Data;
            $this->Valor = $Valor;
        }
    }
?>