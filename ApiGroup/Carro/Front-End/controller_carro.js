class ControllerCarro{  
    constructor() {
        this.carroservice = new APIServiceCarro(); 
    } 

    carregarcarro(){
        const self = this;
        //definição da função que trata o buscar carro com sucesso
        const sucesso = function(carro){
            self.montarTabela(carro);
        }

        //definição da função que trata o erro ao buscar os carro
        const trataErro = function(statusCode) {
            console.log("Erro:",statusCode);
        }

        this.carroervice.buscarcarro(sucesso, trataErro);
    }
    
    montarTabela(carro){
        var str=`<table>
            <tr>
                <th style='text-align: left;'>Chassi</th>
                <th style='text-align: left;'>Modelo</th>
                <th style='text-align: left;'>Versao</th>
                <th style='text-align: left;'>Cor</th>
            </tr>`;
    
        for(var i in carro){
            str+=`<tr>
                    <td>${carro[i].Chassi}</td>
                    <td>${carro[i].Modelo}</td>
                    <td>${carro[i].Versao}</td>
                    <td>${carro[i].Cor}</td>

                </tr>`;
                
        } 
        str+= "</table>";
    
        var tabela = document.querySelector("#tabela");
        tabela.innerHTML = str;
    }

    salvar(event){
        const self = this;
        
        event.preventDefault();
        var carro = new carro();
        carro.nome = document.querySelector("#txtnome").value;
        carro.preco = document.querySelector("#txtpreco").value;

        const sucesso = function(carroCriado) {
            console.log("carro Criado",carroCriado);
            self.carregarcarro();
            self.limparFormulario();
        }

        const trataErro = function(statusCode) {
            console.log("Erro:",statusCode);
        }
                
        this.carroervice.enviarcarro(carro, sucesso, trataErro);    

    }
    
    limparFormulario(){
        document.querySelector("#txtnome").value="";
        document.querySelector("#txtpreco").value="";
    }
    
    
}