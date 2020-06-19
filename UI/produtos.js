var body = document.querySelector("body");
body.onload = function () {
    carregarProdutos();
}

function carregarProdutos() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            montarTabela(JSON.parse(this.responseText));
        }
    };
    xhttp.open("GET", "http://localhost:8080/api/produtos", true);
    xhttp.send();
}

function montarTabela(produtos){
    var str=`<table>
        <tr>
            <th style='text-align: left;'>Id</th>
            <th style='text-align: left;'>Nome</th>
            <th style='text-align: left;'>Preço</th>
        </tr>`;

    for(var i in produtos){
        str+=`<tr>
                <td>${produtos[i].id}</td>
                <td>${produtos[i].nome}</td>
                <td>${produtos[i].preco}</td>
            </tr>`;
            
    } 
    str+= "</table>";

    var tabela = document.querySelector("#tabela");
    tabela.innerHTML = str;
}

function limparFormulario(){
    document.querySelector("#txtnome").value="";
    document.querySelector("#txtpreco").value="";
}

function enviarProduto(produto){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 201) {
            console.log(JSON.parse(this.responseText));
            carregarProdutos();
            limparFormulario();

        }
    };
    xhttp.open("POST", "http://localhost:8080/api/produtos", true);
    xhttp.setRequestHeader("Content-Type","application/json");
    xhttp.send(JSON.stringify(produto));
    
}

var form = document.querySelector("#formulario");
form.onsubmit = function(event){
    event.preventDefault();
    var produto = new Produto();
    produto.nome = document.querySelector("#txtnome").value;
    produto.preco = document.querySelector("#txtpreco").value;
    enviarProduto(produto);
}


