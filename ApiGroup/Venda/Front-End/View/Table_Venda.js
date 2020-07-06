class Table_Venda {
	constructor(controller, seletor){
		this.controller = controller;
		this.seletor = seletor;
	}


	montarTabela(venda){
		var str=`
		<h2>Tabela de venda</h2>
		<a id="novo" href="#">Novo</a>
		<div id="tabela">
		<table>
			<tr>
				<th style='text-align: left;'>idvenda</th>
				<th style='text-align: left;'>venda_data</th>
				<th style='text-align: left;'>valor</th>
				<th style='text-align: left;'>concessionaria</th>
				<th style='text-align: left;'>vendedor</th>
				<th style='text-align: left;'>chassi</th>
				<th colspan="2">Ação</th>
			</tr>`;
	
		for(var i in venda){
			str+=`  <tr id=${venda[i].idvenda}>
					<td>${venda[i].idvenda}</td>
					<td>${venda[i].venda_data}</td>
					<td>${venda[i].valor}</td>
					<td>${venda[i].obj_concessionaria.nomefantasia}</td>
					<td>${venda[i].obj_vendedor.nome}</td>
					<td>${venda[i].obj_carro.chassi}</td>


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