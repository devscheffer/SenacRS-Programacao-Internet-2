class Form_Carro {

	constructor(controller, seletor){
		this.controller = controller;
		this.seletor = seletor;
	}

	montarForm(modelo,versao,cor,carro){
		if(!carro){
			carro = new Carro();
		}
		var str = `
		<h2>Formulario de Carro</h2>
		<form action="" method="post" id="formulario">
			<label for="chassi">chassi</label>
			<input type="text" name="chassi" value="${carro.chassi ?carro.chassi :''}" id="chassi" />
			<br />
			`;

			
			str+=`
			<label for="descmodelo">descmodelo</label>
			<select id="descmodelo">
			`;

			for(const item of modelo){
				str+=`<option id="${item.idmodelo}">${item.descmodelo}</option>`;
			}

			str+=`
			</select>
			<br />
			`;

			str+=`
			<label for="descversao">descversao</label>
			<select id="descversao">
			`;

			for(const item of versao){
				str+=`<option id="${item.idversao}">${item.descversao}</option>`;
			}

			str+=`
			</select>
			<br />
			`;

			str+=`
			<label for="desccor">desccor</label>
			<select id="desccor">
			`;

			for(const item of cor){
				str+=`<option id="${item.idcor}">${item.desccor}</option>`;
			}

			str+=`
			</select>
			<br />
			`;

			str+=`
			<input type="submit" value="Salvar" />
			<input type="reset" value="Cancelar" />
		</form>
		`;

		let containerForm = document.querySelector(this.seletor);
		containerForm.innerHTML = str;

		var form = document.querySelector("#formulario");
		const self = this;
		form.onsubmit = function(event){
			if(!carro.chassi){
				self.controller.salvar(event);
			}
			else{
				self.controller.update_item(carro.chassi,event);
			}
		}

		form.onreset = function(event){
			self.controller.limpar(event);
		}
	}

	limparFormulario(){
		document.querySelector("#chassi").value="";
		document.querySelector("#descmodelo").value="";
		document.querySelector("#descversao").value="";
		document.querySelector("#desccor").value="";
	}

	getDatacarro(){
		let carro = new Carro();
		if(!document.querySelector("#chassi").value);
			carro.chassi = document.querySelector("#chassi").value;
			
			const sel2 = document.querySelector("#descversao");
			const opt2 = sel2.options[sel2.selectedIndex];
			carro.versao = new Versao(opt2.value);
			carro.versao.idversao = opt2.id;
			
			const sel1 = document.querySelector("#descmodelo");
			const opt1 = sel1.options[sel1.selectedIndex];
			carro.versao.modelo = new Modelo(opt1.value);
			carro.versao.modelo.idmodelo = opt1.id;
			
			
			const sel3 = document.querySelector("#desccor");
			const opt3 = sel3.options[sel3.selectedIndex];
			carro.cor = new Cor(opt3.value);
			carro.cor.idcor = opt3.id;
			

		return carro;        
	}

}