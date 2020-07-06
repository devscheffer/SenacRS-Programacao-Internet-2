<?php
include_once(__DIR__.'\..\..\Concessionaria\Back-End\objConcessionaria.php');
include_once(__DIR__.'\..\..\Vendedor\Back-End\objVendedor.php');
include_once(__DIR__.'\..\..\Carro\Back-End\objCarro.php');

    class Venda {
        public $idvenda;
        public $venda_data;
        public $valor;
        public $obj_concessionaria;
        public $obj_vendedor;
        public $obj_carro;

        function __construct(
            $idvenda
            ,$venda_data
            ,$valor
            , $obj_concessionaria
            , $obj_vendedor
            ,$obj_carro
            ){
            $this->idvenda = $idvenda;
            $this->venda_data = $venda_data;
            $this->valor = $valor;
            $this->obj_concessionaria = $obj_concessionaria;
            $this->obj_vendedor = $obj_vendedor;
            $this->obj_carro = $obj_carro;
        }
    }
?>