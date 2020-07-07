class Table_RN1_Ano {
	constructor(controller, seletor){
		this.controller = controller;
		this.seletor = seletor;
	}


	load_list_ano(rn1){
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
			</tr>`;
	
		for(var i in rn1){
			str+=`  
				<tr id=${rn1[i].obj_vendedor.idvendedor}>
					<td>${rn1[i].obj_vendedor.idvendedor}</td>
					<td>${rn1[i].ano}</td>
					<td>${rn1[i].mes}</td>
					<td>${rn1[i].totalvenda}</td>
					<td>${rn1[i].bonus}</td>
					<td>${rn1[i].comissao_mensal}</td> 
				</tr>`;
				
		} 
		str+= `
		</table>
		</div>`;
	
		var tabela = document.querySelector(this.seletor);
		tabela.innerHTML = str;

	}
}