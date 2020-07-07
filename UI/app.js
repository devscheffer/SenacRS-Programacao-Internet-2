// Controller

const ctrl_carro =  new Controller_Carro();
const ctrl_concessionaria =  new Controller_Concessionaria();
const ctrl_cor =  new Controller_Cor();
const ctrl_modelo =  new Controller_Modelo();
const ctrl_venda =  new Controller_Venda();
const ctrl_vendedor =  new Controller_Vendedor();
const ctrl_versao =  new Controller_Versao();
const ctrl_rn1 =  new Controller_RN1();
// const ctrl_rn2 =  new Controller_Rn2();
// const ctrl_rn3 =  new Controller_Rn3();
// const ctrl_rn4 =  new Controller_Rn4();

// Link Navegacao basico

var body = document.querySelector("body");
body.onload = function () {
    document.querySelector("main").innerHTML = `
    <div class="container">
    <img src="../UI/IMG/Home.jpg">
    <div class="top-left">Seja Bem-vindo</div>
    <div class="top-right">2020-07-07</div>
    <div class="bottom-right">Gerson Scheffer</div>
    <div class="centered"><h1>API</h1></div>
    </div>
    `;
}

document.querySelector("#sobre").onclick = function() {
    document.querySelector("main").innerHTML = "<h2>App desenvolvido por Gerson Scheffer</h2>";
}

document.querySelector("#home").onclick = function() {
    document.querySelector("main").innerHTML = `
    <div class="container">
    <img src="../UI/IMG/Home.jpg">
    <div class="top-left">Seja Bem-vindo</div>
    <div class="top-right">2020-07</div>
    <div class="bottom-right">Gerson Scheffer</div>
    <div class="centered"><h1>API</h1></div>
    </div>
    `;
}

// Link de navegacao API

document.querySelector("#carro").onclick = function() {
    ctrl_carro.init();
}
document.querySelector("#concessionaria").onclick = function() {
    ctrl_concessionaria.init();
}
document.querySelector("#cor").onclick = function() {
    ctrl_cor.init();
}
document.querySelector("#modelo").onclick = function() {
    ctrl_modelo.init();
}
document.querySelector("#venda").onclick = function() {
    ctrl_venda.init();
}
document.querySelector("#vendedor").onclick = function() {
    ctrl_vendedor.init();
}
document.querySelector("#versao").onclick = function() {
    ctrl_versao.init();
}

document.querySelector("#RN1").onclick = function() {
    ctrl_rn1.init();
}

// document.querySelector("#rn2").onclick = function() {
//     ctrl_rn2.init();
// }
// document.querySelector("#rn3").onclick = function() {
//     ctrl_rn3.init();
// }
// document.querySelector("#rn4").onclick = function() {
//     ctrl_rn4.init();
// }


