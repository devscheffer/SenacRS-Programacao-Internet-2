<?php
include_once(__DIR__.'\..\..\..\Vendedor\Back-End\objVendedor.php');

    class RN1 {
        public $obj_vendedor;
        public $ano;
        public $mes;
        public $totalvenda;
        public $bonus;
        public $comissao_mensal;

        function __construct(Vendedor $obj_vendedor, $ano, $mes,$totalvenda,$bonus,$comissao_mensal){
            $this->obj_vendedor = $obj_vendedor;
            $this->ano = $ano;
            $this->mes = $mes;
            $this->totalvenda = $totalvenda;
            $this->bonus = $bonus;
            $this->comissao_mensal = $comissao_mensal;
        }
    }
?>