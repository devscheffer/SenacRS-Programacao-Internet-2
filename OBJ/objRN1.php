<?php
    class RN1 {
        public $Vendedor;
        public $Ano;
        public $Mes;
        public $TotalVenda;
        public $Bonus;
        public $ComissaoMensal;

        function __construct($Vendedor, $Ano, $Mes,$TotalVenda,$Bonus,$ComissaoMensal){
            $this->Vendedor = $Vendedor;
            $this->Ano = $Ano;
            $this->Mes = $Mes;
            $this->TotalVenda = $TotalVenda;
            $this->Bonus = $Bonus;
            $this->ComissaoMensal = $ComissaoMensal;
        }
    }
?>