class Controller_Versao{  
	constructor() {
		this.service = new APIService_Versao();
		this.service_modelo = new APIService_Modelo();
		this.table = new Table_Versao(this,"main");
		this.form = new Form_Versao(this,"main");
	} 

	init(){
		this.load_table();
	}

	load_form(){
		event.preventDefault();
		const self = this;

		this.service_modelo.read_item_all(
			function(modelo) 
			{ 
				self.form.montarForm(modelo); 
			},
			function(statusCode) {
				console.log("Erro - status:",statusCode);
			}
	)
	
	}

	load_table(){
		const self = this;
		//definição da função que trata o buscar versao com sucesso
		const sucesso = function(versao){
			self.table.montarTabela(versao);
		}

		//definição da função que trata o erro ao buscar os versao
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
		var versao = this.form.getDataversao();        
		console.log("versao", versao);

		this.create_item(versao);

	}

	create_item(versao){
		const self = this;

		const sucesso = function(versao_Criado) {
			console.log("versao Criado",versao_Criado);
			self.load_table();
			self.form.limparFormulario();
		}

		const trataErro = function(statusCode) {
			console.log("Erro:",statusCode);
		}
				
		this.service.create_item(versao, sucesso, trataErro);    

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

		const ok = function(versao){
			self.service_modelo.read_item_all(
                function(modelo) 
                { 
                    self.form.montarForm(modelo,versao); 
                },
                function(statusCode) {
                    console.log("Erro - status:",statusCode);
                }
            )
		}

		const erro = function(status){
			console.log(status);
		}
		this.service.read_item_id(id,ok,erro);   
	}

	update_item(id,event){
		event.preventDefault();
	
		let versao = this.form.getDataversao();
		
		const self = this;

		this.service.update_item_id(id,versao, 
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
