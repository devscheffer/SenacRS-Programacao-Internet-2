class Controller_RN1{  
	constructor() {
		this.service = new APIService_RN1(); 
		this.table = new Table_RN1(this,"main");
	} 

	init(){
		this.load_table();
	}

	load_table(){
		const self = this;
		//definição da função que trata o buscar rn1 com sucesso
		const sucesso = function(rn1){
			self.table.montarTabela(rn1);
		}

		//definição da função que trata o erro ao buscar os rn1
		const trataErro = function(statusCode) {
			console.log("Erro:",statusCode);
		}

		this.service.read_item_all(sucesso, trataErro);
	}

	read_rn_vendedor_id(id, event){
		event.preventDefault();             
		const self = this;

		const ok = function(rn1){
			self.service_modelo.read_item_all(
                function(modelo) { 
                    self.service_versao.read_item_all(
						function(versao) 
						{ 
							self.service_cor.read_item_all(
								function(cor) 
								{ 
									self.form.montarForm(modelo,versao,cor,rn1); 
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

		this.service.read_rn_vendedor_id(id,ok,erro);   
	}
}
