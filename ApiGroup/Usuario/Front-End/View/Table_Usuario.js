class Table_Usuario {
	constructor(controller, seletor){
		this.controller = controller;
		this.seletor = seletor;
	}


	montarTabela(usuario){
		var str=`
		<h2>Tabela de usuario</h2>
		<a id="novo" href="#">Novo</a>
		<div id="tabela">
		<table>
			<tr>
				<th style='text-align: left;'>id</th>
				<th style='text-align: left;'>nome</th>
				<th style='text-align: left;'>login</th>
				<th style='text-align: left;'>senha</th>
				<th colspan="2">Ação</th>
			</tr>`;
	
		for(var i in usuario){
			str+=`  <tr id=${usuario[i].id}>
					<td>${usuario[i].id}</td>
					<td>${usuario[i].nome}</td>
					<td>${usuario[i].login}</td>
					<td>${usuario[i].senha}</td>

					<td><a class="edit" href="#">Editar</a></td>
					<td><a class="delete" href="#">Deletar</a></td>    
				</tr>`;
				
		} 
		str+= `
		</table>
		</div>`;
	
		var tabela = document.querySelector(this.seletor);
		tabela.innerHTML = str;

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