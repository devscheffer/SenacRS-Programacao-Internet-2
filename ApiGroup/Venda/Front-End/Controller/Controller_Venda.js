class Controller_Venda{  
	constructor() {
		this.service = new APIService_Venda(); 
		this.service_concessionaria = new APIService_Concessionaria();
		this.service_vendedor = new APIService_Vendedor();
		this.service_carro = new APIService_Carro();
		this.table = new Table_Venda(this,"main");
		this.form = new Form_Venda(this,"main");
	} 

	init(){
		this.load_table();
	}

	load_form(){
		event.preventDefault();
		const self = this;

		self.service_concessionaria.read_item_all(
			function(concessionaria) 
			{ 
				self.service_vendedor.read_item_all(
					function(vendedor) 
					{ 
						self.service_carro.read_item_all(
							function(carro) 
							{ 
								self.form.montarForm(concessionaria,vendedor,carro); 
							}
						)
					}
				) 
			},
			function(statusCode) {
				console.log("Erro - status:",statusCode);
			}
		)
	}

	load_table(){
		const self = this;
		//definição da função que trata o buscar venda com sucesso
		const sucesso = function(venda){
			self.table.montarTabela(venda);
		}

		//definição da função que trata o erro ao buscar os venda
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
		var venda = this.form.getDatavenda();        
		console.log("venda", venda);

		this.create_item(venda);

	}

	create_item(venda){
		const self = this;

		const sucesso = function(venda_Criado) {
			console.log("venda Criado",venda_Criado);
			self.load_table();
			self.form.limparFormulario();
		}

		const trataErro = function(statusCode) {
			console.log("Erro:",statusCode);
		}
				
		this.service.create_item(venda, sucesso, trataErro);    

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

		const ok = function(venda){
			self.service_concessionaria.read_item_all(
                function(concessionaria) { 
                    self.service_vendedor.read_item_all(
						function(vendedor) { 
							self.service_carro.read_item_all(
								function(carro) 
								{ 
									self.form.montarForm(concessionaria,vendedor,carro,venda); 
								}
							)
						}
					) 
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
	
		let venda = this.form.getDatavenda();
		
		const self = this;

		this.service.update_item_id(id,venda, 
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
