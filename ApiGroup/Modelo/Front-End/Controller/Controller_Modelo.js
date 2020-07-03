class Controller_Modelo{  
	constructor() {
		this.service = new APIService_Modelo(); 
		this.table = new Table_Modelo(this,"main");
		this.form = new Form_Modelo(this,"main");
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
		//definição da função que trata o buscar modelo com sucesso
		const sucesso = function(modelo){
			self.table.montarTabela(modelo);
		}

		//definição da função que trata o erro ao buscar os modelo
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
		var modelo = this.form.getDatamodelo();        
		console.log("modelo", modelo);

		this.create_item(modelo);

	}

	create_item(modelo){
		const self = this;

		const sucesso = function(modelo_Criado) {
			console.log("modelo Criado",modelo_Criado);
			self.load_table();
			self.form.limparFormulario();
		}

		const trataErro = function(statusCode) {
			console.log("Erro:",statusCode);
		}
				
		this.service.create_item(modelo, sucesso, trataErro);    

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
		const ok = function(modelo){
			self.form.montarForm(modelo);
		}
		const erro = function(status){
			console.log(status);
		}

		this.service.read_item_id(id,ok,erro);   
	}

	update_item(id,event){
		event.preventDefault();
	
		let modelo = this.form.getDatamodelo();
		
		const self = this;

		this.service.update_item_id(id,modelo, 
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
