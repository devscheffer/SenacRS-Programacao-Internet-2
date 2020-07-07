class Table_RN1 {
	constructor(controller, seletor){
		this.controller = controller;
		this.seletor = seletor;
	}


	montarTabela(rn1){
		var str=`
		<h2>Tabela de rn1</h2>
		<div id="tabela">
		<table>
			<tr>
				<th style='text-align: left;'>idvendedor</th>
				<th style='text-align: left;'>ano</th>
				<th style='text-align: left;'>mes</th>
				<th style='text-align: left;'>totalvenda</th>
				<th style='text-align: left;'>bonus</th>
				<th style='text-align: left;'>comissao_mensal</th>
				<th colspan="2">Ação</th>
			</tr>`;
	
		for(var i in rn1){
			str+=`  <tr>
					<td id=${rn1[i].obj_vendedor.idvendedor}>
						<a class="vendedor" href="#">${rn1[i].obj_vendedor.idvendedor}</a></td>
					<td id=${rn1[i].ano}>
						<a class="ano" href="#">${rn1[i].ano}</a></td>
					<td id=${rn1[i].mes}>
						<a class="mes" href="#">${rn1[i].mes}</a></td>
					<td>${rn1[i].totalvenda}</td>
					<td>${rn1[i].bonus}</td>
					<td>${rn1[i].comissao_mensal}</td>
				</tr>`;
		} 
		str+= `
		</table>
		</div>
		
		`;
	
		var tabela = document.querySelector(this.seletor);
		tabela.innerHTML = str;
		

		const linksEdit1 = document.querySelectorAll(".vendedor");
		for(let linkEdit of linksEdit1)
		{
			const id = linkEdit.parentNode.id;
			//Outra forma de tratar o evento (click) - nesse caso deve ter bind
			linkEdit.addEventListener("click",this.controller.read_item_id.bind(this.controller,id));
		}

		const linksEdit2 = document.querySelectorAll(".ano");
		for(let linkEdit of linksEdit2)
		{
			
			const id = linkEdit.parentNode.id;
			//Outra forma de tratar o evento (click) - nesse caso deve ter bind
			linkEdit.addEventListener("click",this.controller.read_item_ano.bind(this.controller,id));
		}
		

		const linksEdit3 = document.querySelectorAll(".mes");
		
		
		for(let linkEdit of linksEdit3)
		{
			const id1 = linkEdit.parentNode.id;
			// const id2 = linkEdit.parentNode.parentNode;
			const id2 = linkEdit.parentNode.parentNode.childNodes[3].id;

			// const id2 = linkEdit.parentNode.parentNode.querySelector('.ano');
			console.log(id2);
			
			//Outra forma de tratar o evento (click) - nesse caso deve ter bind
			linkEdit.addEventListener("click",this.controller.read_item_anomes.bind(this.controller,id2,id1));
		}
	}

}