class APIServiceCarro {
    uri = "http://localhost:8000/api/carro";

    buscarCarro(ok, erro) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4) {
                if(this.status === 200) {
                    //Chama o método sucesso definido no carregarCarro() do controller
                    ok(JSON.parse(this.responseText));
                }
                else {
                    //Chama o método trataErro definido no carregarCarro() do controller
                    erro(this.status);
                }
            }
        };
        xhttp.open("GET", this.uri, true);
        xhttp.send();
    }


    enviarCarro(Carro, ok, erro){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4){ 
                if(this.status === 201) {    
                    ok(JSON.parse(this.responseText))
                }
                else {
                    erro(this.status);
                }
            }
        };
        xhttp.open("POST", this.uri, true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(JSON.stringify(Carro));
        
    }

}