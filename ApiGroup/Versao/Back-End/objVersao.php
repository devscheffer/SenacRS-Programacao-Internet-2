<?php
include_once(__DIR__.'\..\..\Modelo\Back-End\objModelo.php');

    class Versao {
        public $idversao;
        public $obj_modelo;
        public $descversao;

        function __construct(
            $idversao
            ,$descversao
            ,Modelo $obj_modelo
            ){
            $this->idversao = $idversao;
            $this->obj_modelo = $obj_modelo;
            $this->descversao = $descversao;
        }
    }
?>