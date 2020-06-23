class APIService_carro {
    uri = "http://localhost:8000/api/carro";

    buscarcarro(ok, erro) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4) {
                if(this.status === 200) {
                    //Chama o método sucesso definido no carregarcarro() do controller
                    ok(JSON.parse(this.responseText));
                }
                else {
                    //Chama o método trataErro definido no carregarcarro() do controller
                    erro(this.status);
                }
            }
        };
        xhttp.open("GET", this.uri, true);
        xhttp.send();
    }


    enviarcarro(carro, ok, erro){
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
        xhttp.send(JSON.stringify(carro));
        
    }

}