// const produtoController =  new ProdutoController();
// const marcaController =  new MarcaController();
// Controller
const ctrl_cor =  new Controller_Cor();


var body = document.querySelector("body");
body.onload = function () {
    document.querySelector("main").innerHTML = "<h2>HOME</h2>";
}

document.querySelector("#sobre").onclick = function() {
    document.querySelector("main").innerHTML = "<h2>App desenvolvido por Gerson Scheffer</h2>";
}

document.querySelector("#home").onclick = function() {
    document.querySelector("main").innerHTML = "<h2>HOME</h2>";
}

// Link de navegacao
document.querySelector("#cor").onclick = function() {
    ctrl_cor.init();
}


// document.querySelector("#produtos").onclick = function() {
//     produtoController.inicializa();
// }



