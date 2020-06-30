class Controller_Carro{  
	constructor() {
		this.service = new APIService_Carro(); 
		this.table = new Table_Carro(this,"main");
		this.form = new Form_Carro(this,"main");
	} 

	init(){
		this.load_table();
	}

	load_form(){
		event.preventDefault();
		this.form.montarForm();
	}

	load_table(){
		const self = this;
		//definição da função que trata o buscar carro com sucesso
		const sucesso = function(carro){
			self.table.montarTabela(carro);
		}

		//definição da função que trata o erro ao buscar os carro
		const trataErro = function(statusCode) {
			console.log("Erro:",statusCode);
		}

		this.service.search(sucesso, trataErro);
	}

	limpar(event){
		event.preventDefault();
		this.form.limparFormulario();
		this.load_table();
	}
	
	salvar(event){        
		event.preventDefault();
		var carro = this.form.getDatacarro();        
		console.log("carro", carro);

		this.salvarcarro(carro);

	}

	salvarcarro(carro){
		const self = this;

		const sucesso = function(carroCriado) {
			console.log("carro Criado",carroCriado);
			self.load_table();
			self.form.limparFormulario();
		}

		const trataErro = function(statusCode) {
			console.log("Erro:",statusCode);
		}
				
		this.service.send(carro, sucesso, trataErro);    

	}

	deletarcarro(id, event){
		const self = this;
		this.service.deletarcarro(id, 
			//colocar direto a funcao no parametro
			//nao precisa criar a variavel ok e erro
			function() {
				self.load_table();
			},
			function(status) { 
				console.log(status);
			}
		);
	}

	carregaFormularioComcarro(id, event){
		event.preventDefault();             
		
		const self = this;
		const ok = function(carro){
			self.form.montarForm(carro);
		}
		const erro = function(status){
			console.log(status);
		}

		this.service.search(id,ok,erro);   
	}

	editar(id,event){
		event.preventDefault();
	
		let carro = this.form.getDatacarro();
		
		const self = this;

		this.service.atualizarcarro(id,carro, 
			function() {
				self.form.limparFormulario();
				self.load_table();
			},
			function(status) {
				console.log(status);
			} 
		);

	}

		
}