<?php
include_once(__DIR__.'\..\..\Concessionaria\Back-End\objConcessionaria.php');

    class vendedor {
        public $idvendedor;
        public $nome;
        public $email;
        public $concessionaria;

        function __construct(
            $idvendedor
            , $nome
            , $email
            ,Concessionaria $obj_concessionaria
            ){
            $this->idvendedor = $idvendedor;
            $this->nome = $nome;
            $this->email = $email;
            $this->obj_concessionaria = $obj_concessionaria;
        }
    }
?>