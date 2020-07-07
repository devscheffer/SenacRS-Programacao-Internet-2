class Form_Venda {

    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }

    montarForm(concessionaria,vendedor,carro,venda){
        var str = `
        <h2>Formulario de Venda</h2>
        <form action="" method="post" id="formulario">
            <label for="idvenda">idvenda</label>
        `;

        if(!venda){
            venda = new Venda();
        
            str+=`
			<input type="text" name="idvenda" value="${venda.idvenda ?venda.idvenda :''}" id="idvenda" />

            `;

        }
        else{
            str+=`
			<input type="text" name="idvenda" value="${venda.idvenda ?venda.idvenda :''}" id="idvenda" readonly/>
            `;
        }

            
         str += `
            <br />
            `;

            str+=`
			<label for="venda_data">venda_data</label>
			<input type="text" name="venda_data" value="${venda.venda_data ?venda.venda_data :''}" id="venda_data" />
            <br />
			<label for="valor">valor</label>
			<input type="text" name="valor" value="${venda.valor ?venda.valor :''}" id="valor" />
            <br />
            `;

			str+=`
			<label for="concessionaria">concessionaria</label>
			<select id="concessionaria">
			`;

			for(const item of concessionaria){
				str+=`<option id="${item.idconcessionaria}">${item.nomefantasia}</option>`;
			}

			str+=`
			</select>
			<br />
            `;

			str+=`
			<label for="vendedor">vendedor</label>
			<select id="vendedor">
			`;

			for(const item of vendedor){
				str+=`<option id="${item.idvendedor}">${item.nome}</option>`;
			}

			str+=`
			</select>
			<br />
            `;
            
			str+=`
			<label for="chassi">chassi</label>
			<select id="chassi">
			`;

			for(const item of carro){
				str+=`<option id="${item.chassi}">${item.chassi}</option>`;
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
            if(!venda.idvenda){
                self.controller.salvar(event);
            }
            else{
                self.controller.update_item(venda.idvenda,event);
            }
        }

        form.onreset = function(event){
            self.controller.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#idvenda").value="";
        document.querySelector("#venda_data").value="";
        document.querySelector("#valor").value="";
        document.querySelector("#concessionaria").value="";
        document.querySelector("#vendedor").value="";
        document.querySelector("#chassi").value="";

    }

    getDatavenda(){
        let venda = new Venda();
        if(!document.querySelector("#idvenda").value);

            venda.idvenda = document.querySelector("#idvenda").value;
            venda.venda_data = document.querySelector("#venda_data").value;
            venda.valor = document.querySelector("#valor").value;

            const sel1 = document.querySelector("#concessionaria");
			const opt1 = sel1.options[sel1.selectedIndex];
			venda.concessionaria = new Concessionaria(opt1.value);
            venda.concessionaria.idconcessionaria = opt1.id;
            
            const sel2 = document.querySelector("#vendedor");
			const opt2 = sel2.options[sel2.selectedIndex];
			venda.vendedor = new Vendedor(opt2.value);
            venda.vendedor.idvendedor = opt2.id;
            
            const sel3 = document.querySelector("#chassi");
			const opt3 = sel3.options[sel3.selectedIndex];
			venda.carro = new Carro(opt3.value);
			venda.carro.chassi= opt3.id;

        return venda;        
    }

}