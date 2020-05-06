<?php
    class Versao {
        public $IDVersao;
        public $IDModelo;
        public $DescVersao;


        function __construct($IDVersao, $IDModelo, $DescVersao){
            $this->IDVersao = $IDVersao;
            $this->IDModelo = $IDModelo;
            $this->DescVersao = $DescVersao;

        }
    }
?>