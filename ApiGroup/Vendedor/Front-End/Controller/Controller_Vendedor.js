class Controller_Vendedor{  
	constructor() {
		this.service = new APIService_Vendedor(); 
		this.service_concessionaria = new APIService_Concessionaria();
		this.table = new Table_Vendedor(this,"main");
		this.form = new Form_Vendedor(this,"main");
	} 

	init(){
		this.load_table();
	}

	load_form(){
		event.preventDefault();
		const self = this;

		this.service_concessionaria.read_item_all(
			function(concessionaria) 
			{ 
				self.form.montarForm(concessionaria); 
			},
			function(statusCode) {
				console.log("Erro - status:",statusCode);
			}
		)
	}

	load_table(){
		const self = this;
		//definição da função que trata o buscar vendedor com sucesso
		const sucesso = function(vendedor){
			self.table.montarTabela(vendedor);
		}

		//definição da função que trata o erro ao buscar os vendedor
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
		var vendedor = this.form.getDatavendedor();        
		console.log("vendedor", vendedor);

		this.create_item(vendedor);

	}

	create_item(vendedor){
		const self = this;

		const sucesso = function(vendedor_Criado) {
			console.log("vendedor Criado",vendedor_Criado);
			self.load_table();
			self.form.limparFormulario();
		}

		const trataErro = function(statusCode) {
			console.log("Erro:",statusCode);
		}
				
		this.service.create_item(vendedor, sucesso, trataErro);    

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

		const ok = function(vendedor){
			self.service_concessionaria.read_item_all(
                function(concessionaria) 
                { 
                    self.form.montarForm(concessionaria,vendedor); 
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
	
		let vendedor = this.form.getDatavendedor();
		
		const self = this;

		this.service.update_item_id(id,vendedor, 
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
