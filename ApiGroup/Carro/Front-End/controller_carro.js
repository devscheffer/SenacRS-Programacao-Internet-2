class Controller_carro {
	constructor() {
		this.carroservice = new APIService_carro();
	}

	carregarcarro() {
		const self = this;
		//definição da função que trata o buscar carro com sucesso
		const sucesso = function (carro) {
			self.montarTabela(carro);
		};

		//definição da função que trata o erro ao buscar os carro
		const trataErro = function (statusCode) {
			console.log("Erro:", statusCode);
		};

		this.carroservice.buscarcarro(sucesso, trataErro);
	}

	montarTabela(carro) {
		var str = `<table>
            <tr>
                <th style='text-align: left;'>Chassi</th>
                <th style='text-align: left;'>Modelo</th>
                <th style='text-align: left;'>Versao</th>
                <th style='text-align: left;'>Cor</th>
            </tr>`;

		for (var i in carro) {
			str += `<tr>
                    <td>${carro[i].chassi}</td>
                    <td>${carro[i].modelo}</td>
                    <td>${carro[i].versao}</td>
                    <td>${carro[i].cor}</td>
                </tr>`;
		}
		str += "</table>";

		var tabela = document.querySelector("#tabela");
		tabela.innerHTML = str;
	}

	salvar(event) {
		const self = this;

		event.preventDefault();
		var Carro = new carro();
		Carro.chassi = document.querySelector("#chassi").value;
		Carro.modelo = document.querySelector("#modelo").value;
		Carro.versao = document.querySelector("#versao").value;
		Carro.cor = document.querySelector("#cor").value;
        
		const sucesso = function (carroCriado) {
			console.log("carro Criado", carroCriado);
			self.carregarcarro();
			self.limparFormulario();
		};

		const trataErro = function (statusCode) {
			console.log("Erro:", statusCode);
		};

		this.carroservice.enviarcarro(Carro, sucesso, trataErro);
	}

	limparFormulario() {
		document.querySelector("#chassi").value = "";
		document.querySelector("#modelo").value = "";
		document.querySelector("#versao").value = "";
		document.querySelector("#cor").value = "";
	}
}
