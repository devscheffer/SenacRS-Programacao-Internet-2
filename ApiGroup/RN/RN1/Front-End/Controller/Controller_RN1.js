class Controller_RN1{  
	constructor() {
		this.service = new APIService_RN1(); 
		this.table = new Table_RN1(this,"main");
		this.table_vendedor = new Table_RN1_Vendedor(this,"main");
		this.table_ano = new Table_RN1_Ano(this,"main");
		this.table_anomes = new Table_RN1_AnoMes(this,"main");



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

	read_item_id(id, event){
		event.preventDefault();             
		const self = this;


		const ok = function(id){
			self.table_vendedor.load_list_vendedor_id(id); 
		}

		const erro = function(status){
			console.log(status);
		}

		this.service.read_rn_vendedor_id(id,ok,erro);   
	}

	read_item_ano(ano, event){
		event.preventDefault();             
		const self = this;


		const ok = function(ano){
			self.table_ano.load_list_ano(ano); 
		}

		const erro = function(status){
			console.log(status);
		}

		this.service.read_rn_ano(ano,ok,erro);   
	}

	read_item_anomes(ano,mes, event){
		event.preventDefault();             
		const self = this;


		const ok = function(ano){
			self.table_anomes.load_list_anomes(ano,mes); 
		}

		const erro = function(status){
			console.log(status);
		}

		this.service.read_rn_anomes(ano,mes,ok,erro);   
	}
}
