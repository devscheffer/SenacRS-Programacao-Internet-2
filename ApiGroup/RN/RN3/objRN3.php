<?php
    class RN3 {
        public $concessionaria;
        public $ano;
        public $mes;
        public $distlucro;


        function __construct($concessionaria, $ano, $mes,$distlucro){
            $this->concessionaria = $concessionaria;
            $this->ano = $ano;
            $this->mes = $mes;
            $this->distlucro = $distlucro;
        }
    }
?>