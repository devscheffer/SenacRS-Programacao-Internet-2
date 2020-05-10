<?php
    class Venda {
        public $idsale;
        public $concessionaria;
        public $vendedor;
        public $chassi;
        public $data;
        public $valor;

        function __construct($idsale, $concessionaria, $vendedor,$chassi,$data,$valor){
            $this->idsale = $idsale;
            $this->concessionaria = $concessionaria;
            $this->vendedor = $vendedor;
            $this->chassi = $chassi;
            $this->data = $data;
            $this->valor = $valor;
        }
    }
?>