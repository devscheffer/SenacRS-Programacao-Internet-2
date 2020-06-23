const ControllerCarro =  new ControllerCarro();

var body = document.querySelector("body");
body.onload = function () {
    ControllerCarro.carregarcarro();
}


var form = document.querySelector("#formulario");
form.onsubmit = function(event){
    ControllerCarro.salvar(event);
}


