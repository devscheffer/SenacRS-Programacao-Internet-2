class Controller_Cor{  
	constructor() {
		this.service = new APIService_Cor(); 
		this.table = new Table_Cor(this,"main");
		this.form = new Form_Cor(this,"main");
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
		//definição da função que trata o buscar cor com sucesso
		const sucesso = function(cor){
			self.table.montarTabela(cor);
		}

		//definição da função que trata o erro ao buscar os cor
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
		var cor = this.form.getDatacor();        
		console.log("cor", cor);

		this.create_item(cor);

	}

	create_item(cor){
		const self = this;

		const sucesso = function(cor_Criado) {
			console.log("cor Criado",cor_Criado);
			self.load_table();
			self.form.limparFormulario();
		}

		const trataErro = function(statusCode) {
			console.log("Erro:",statusCode);
		}
				
		this.service.create_item(cor, sucesso, trataErro);    

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
		const ok = function(cor){
			self.form.montarForm(cor);
		}
		const erro = function(status){
			console.log(status);
		}

		this.service.read_item_id(id,ok,erro);   
	}

	update_item(id,event){
		event.preventDefault();
	
		let cor = this.form.getDatacor();
		
		const self = this;

		this.service.update_item_id(id,cor, 
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
