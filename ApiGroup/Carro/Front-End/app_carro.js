const Controller_carro =  new Controller_carro();

var body = document.querySelector("body");
body.onload = function () {
    Controller_carro.carregarcarro();
}


var form = document.querySelector("#formulario");
form.onsubmit = function(event){
    Controller_carro.salvar(event);
}


