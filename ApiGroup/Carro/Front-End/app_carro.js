const controller_carro =  new Controller_carro();

var body = document.querySelector("body");
body.onload = function () {
    controller_carro.carregarcarro();
}


var form = document.querySelector("#formulario");
form.onsubmit = function(event){
    controller_carro.salvar(event);
}


