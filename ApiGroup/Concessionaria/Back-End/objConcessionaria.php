<?php
    class concessionaria {
        public $idconcessionaria;
        public $nomefantasia;
        public $uf;
        public $municipio;

        function __construct($idconcessionaria, $nomefantasia, $uf,$municipio){
            $this->idconcessionaria = $idconcessionaria;
            $this->nomefantasia = $nomefantasia;
            $this->uf = $uf;
            $this->municipio = $municipio;
        }
    }
?>