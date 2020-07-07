class Table_Carro {
	constructor(controller, seletor){
		this.controller = controller;
		this.seletor = seletor;
	}


	montarTabela(carro){
		var str=`
		<h2>Tabela de Carro</h2>
		<a id="novo" href="#">Novo</a>
		<div id="tabela">
		<table>
            <thead>
                <th data-field="chassi">chassi</th>
                <th data-field="Modelo">Modelo</th>
                <th data-field="Versao">Versao</th>
                <th data-field="Cor">Cor</th>
				<th data-field="Acao" colspan="2">Acao</th>
			</thead>`;
	
		for(var i in carro){
			str+=` 
				<tr id=${carro[i].chassi}>
					<td>${carro[i].chassi}</td>
					<td>${carro[i].obj_versao.obj_modelo.descmodelo}</td>
					<td>${carro[i].obj_versao.descversao}</td>
					<td>${carro[i].obj_cor.desccor}</td>

					<td><a class="edit" href="#">Editar</a></td>
					<td><a class="delete" href="#">Deletar</a></td>    
				</tr>`;
				
		} 
		str+= `
		</table>
		</div>
		`;
	
		var tabela = document.querySelector(this.seletor);
		tabela.innerHTML = str;
		console.log(tabela.innerHTML);
		

		const self = this;
		const linkNovo = document.querySelector("#novo");
		linkNovo.onclick = function(event) {
			self.controller.load_form(event);
		}

		const linksDelete = document.querySelectorAll(".delete");
		for(let linkDelete of linksDelete)
		{
			const id = linkDelete.parentNode.parentNode.id;
			linkDelete.onclick = function(event){
				self.controller.delete_item(id);
			}
		}

		const linksEdit = document.querySelectorAll(".edit");
		for(let linkEdit of linksEdit)
		{
			const id = linkEdit.parentNode.parentNode.id;
			//Outra forma de tratar o evento (click) - nesse caso deve ter bind
			linkEdit.addEventListener("click",this.controller.read_item_id.bind(this.controller,id));
		}

	}

}