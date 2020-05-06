<?php
    class Vendedor {
        public $IDVendedor;
        public $Nome;
        public $Email;
        public $Concessionaria;

        function __construct($IDVendedor, $Nome, $Email,$Concessionaria){
            $this->IDVendedor = $IDVendedor;
            $this->Nome = $Nome;
            $this->Email = $Email;
            $this->Concessionaria = $Concessionaria;
        }
    }
?>