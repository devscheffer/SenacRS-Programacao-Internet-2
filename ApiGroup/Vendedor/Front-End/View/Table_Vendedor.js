class Table_Vendedor {
	constructor(controller, seletor){
		this.controller = controller;
		this.seletor = seletor;
	}


	montarTabela(vendedor){
		var str=`
		<h2>Tabela de vendedor</h2>
		<a id="novo" href="#">Novo</a>
		<div id="tabela">
		<table>
			<tr>
				<th style='text-align: left;'>idvendedor</th>
				<th style='text-align: left;'>nome</th>
				<th style='text-align: left;'>email</th>
				<th style='text-align: left;'>concessionaria</th>
				<th colspan="2">Ação</th>
			</tr>`;
	
		for(var i in vendedor){
			str+=`  <tr id=${vendedor[i].idvendedor}>
					<td>${vendedor[i].idvendedor}</td>
					<td>${vendedor[i].nome}</td>
					<td>${vendedor[i].email}</td>
					<td>${vendedor[i].obj_concessionaria.nomefantasia}</td>

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