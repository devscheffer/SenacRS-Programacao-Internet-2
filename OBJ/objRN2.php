<?php
    class RN2 {
        public $Vendedor;
        public $Ano;
        public $Mes;
        public $Modelo;
        public $NModelo;
        public $Bonus;
        public $Comissao_Modelo;

        function __construct($Vendedor, $Ano, $Mes,$Modelo,$NModelo,$Bonus,$Comissao_Modelo){
            $this->Vendedor = $Vendedor;
            $this->Ano = $Ano;
            $this->Mes = $Mes;
            $this->Modelo = $Modelo;
            $this->NModelo = $NModelo;
            $this->Bonus = $Bonus;
            $this->Comissao_Modelo = $Comissao_Modelo;
        }
    }
?>