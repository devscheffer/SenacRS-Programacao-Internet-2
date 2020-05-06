<?php
    class Modelo {
        public $IDModelo;
        public $DescModelo;


        function __construct($IDModelo, $DescModelo){
            $this->IDModelo = $IDModelo;
            $this->DescModelo = $DescModelo;

        }
    }
?>