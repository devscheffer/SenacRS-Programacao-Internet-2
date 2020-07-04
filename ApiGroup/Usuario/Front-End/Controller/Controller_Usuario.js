class Controller_Usuario{  
	constructor() {
		this.service = new APIService_Usuario(); 
		this.table = new Table_Usuario(this,"main");
		this.form = new Form_Usuario(this,"main");
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
		//definição da função que trata o buscar usuario com sucesso
		const sucesso = function(usuario){
			self.table.montarTabela(usuario);
		}

		//definição da função que trata o erro ao buscar os usuario
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
		var usuario = this.form.getDatausuario();        
		console.log("usuario", usuario);

		this.create_item(usuario);

	}

	create_item(usuario){
		const self = this;

		const sucesso = function(usuario_Criado) {
			console.log("usuario Criado",usuario_Criado);
			self.load_table();
			self.form.limparFormulario();
		}

		const trataErro = function(statusCode) {
			console.log("Erro:",statusCode);
		}
				
		this.service.create_item(usuario, sucesso, trataErro);    

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
		const ok = function(usuario){
			self.form.montarForm(usuario);
		}
		const erro = function(status){
			console.log(status);
		}

		this.service.read_item_id(id,ok,erro);   
	}

	update_item(id,event){
		event.preventDefault();
	
		let usuario = this.form.getDatausuario();
		
		const self = this;

		this.service.update_item_id(id,usuario, 
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
