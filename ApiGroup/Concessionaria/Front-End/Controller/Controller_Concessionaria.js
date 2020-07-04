class Controller_Concessionaria{  
	constructor() {
		this.service = new APIService_Concessionaria(); 
		this.table = new Table_Concessionaria(this,"main");
		this.form = new Form_Concessionaria(this,"main");
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
		//definição da função que trata o buscar concessionaria com sucesso
		const sucesso = function(concessionaria){
			self.table.montarTabela(concessionaria);
		}

		//definição da função que trata o erro ao buscar os concessionaria
		const trataErro = function(statusCode) {
			console.log("Erro:",statusCode);
		}

		this.service.read_item_all(sucesso, trataErro);
	}

	limpar(event){
		event.preventDefault();
		this.form.limparFormulario();
		this.load_table();
	}
	
	salvar(event){        
		event.preventDefault();
		var concessionaria = this.form.getDataconcessionaria();        
		console.log("concessionaria", concessionaria);

		this.create_item(concessionaria);

	}

	create_item(concessionaria){
		const self = this;

		const sucesso = function(concessionaria_Criado) {
			console.log("concessionaria Criado",concessionaria_Criado);
			self.load_table();
			self.form.limparFormulario();
		}

		const trataErro = function(statusCode) {
			console.log("Erro:",statusCode);
		}
				
		this.service.create_item(concessionaria, sucesso, trataErro);    

	}

	delete_item(id, event){
		const self = this;
		this.service.delete_item_id(id, 
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

	read_item_id(id, event){
		event.preventDefault();             
		
		const self = this;
		const ok = function(concessionaria){
			self.form.montarForm(concessionaria);
		}
		const erro = function(status){
			console.log(status);
		}

		this.service.read_item_id(id,ok,erro);   
	}

	update_item(id,event){
		event.preventDefault();
	
		let concessionaria = this.form.getDataconcessionaria();
		
		const self = this;

		this.service.update_item_id(id,concessionaria, 
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
