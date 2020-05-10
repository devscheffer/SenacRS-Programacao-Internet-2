<?php
    class RN1 {
        public $vendedor;
        public $ano;
        public $mes;
        public $totalvenda;
        public $bonus;
        public $comissao_mensal;

        function __construct($vendedor, $ano, $mes,$totalvenda,$bonus,$comissao_mensal){
            $this->vendedor = $vendedor;
            $this->ano = $ano;
            $this->mes = $mes;
            $this->totalvenda = $totalvenda;
            $this->bonus = $bonus;
            $this->comissao_mensal = $comissao_mensal;
        }
    }
?>