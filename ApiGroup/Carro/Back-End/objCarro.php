<?php
class Carro 
{
    public $chassi;
    public $modelo;
    public $versao;
    public $cor;

    function __construct($chassi, $modelo, $versao,$cor)
    {
        $this->chassi = $chassi;
        $this->modelo = $modelo;
        $this->versao = $versao;
        $this->cor = $cor;
    }
}
?>