<?php
include_once(__DIR__.'\..\..\Modelo\Back-End\objModelo.php');
include_once(__DIR__.'\..\..\Versao\Back-End\objVersao.php');
include_once(__DIR__.'\..\..\Cor\Back-End\objCor.php');


class Carro 
{
    public $chassi;
    public $obj_versao;
    public $obj_cor;

    function __construct($chassi,Versao $obj_versao,Cor $obj_cor)
    {
        $this->chassi = $chassi;
        $this->obj_versao = $obj_versao;
        $this->obj_cor = $obj_cor;
    }
}
?>