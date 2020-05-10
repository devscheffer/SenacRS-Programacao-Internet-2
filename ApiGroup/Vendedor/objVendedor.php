<?php
    class vendedor {
        public $idvendedor;
        public $nome;
        public $email;
        public $concessionaria;

        function __construct($idvendedor, $nome, $email,$concessionaria){
            $this->idvendedor = $idvendedor;
            $this->nome = $nome;
            $this->email = $email;
            $this->concessionaria = $concessionaria;
        }
    }
?>