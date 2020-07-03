<?php
    class RN2 {
        public $vendedor;
        public $ano;
        public $mes;
        public $modelo;
        public $nmodelo;
        public $bonus;
        public $comissao_modelo;

        function __construct($vendedor, $ano, $mes,$modelo,$nmodelo,$bonus,$comissao_modelo){
            $this->vendedor = $vendedor;
            $this->ano = $ano;
            $this->mes = $mes;
            $this->modelo = $modelo;
            $this->nmodelo = $nmodelo;
            $this->bonus = $bonus;
            $this->comissao_modelo = $comissao_modelo;
        }
    }
?>