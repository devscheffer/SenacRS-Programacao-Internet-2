<?php
    class RN4 {
        public $idvendedor;
        public $uf;
        public $ano;
        public $mes;


        function __construct($idvendedor, $uf, $ano,$mes){
            $this->idvendedor = $idvendedor;
            $this->uf = $uf;
            $this->ano = $ano;
            $this->mes = $mes;
        }
    }
?>