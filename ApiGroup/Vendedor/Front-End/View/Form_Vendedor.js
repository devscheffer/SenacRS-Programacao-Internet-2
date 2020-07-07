class Form_Vendedor {

    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }

    montarForm(concessionaria,vendedor){
        var str = `

        <h2>Formulario de Vendedor</h2>
		<form action="" method="post" id="formulario">
			<label for="idvendedor">idvendedor</label>
        `;

        if(!vendedor){
            vendedor = new Vendedor();
        
            str+=`
			<input type="text" name="idvendedor" value="${vendedor.idvendedor ?vendedor.idvendedor :''}" id="idvendedor" />

            `;

        }
        else{
            str+=`
			<input type="text" name="idvendedor" value="${vendedor.idvendedor ?vendedor.idvendedor :''}" id="idvendedor" readonly/>
            `;
        }

        
        str += `
            <br />
			<label for="nome">nome</label>
			<input type="text" name="nome" value="${vendedor.nome ?vendedor.nome :''}" id="nome" />
			<br />
			<label for="email">email</label>
			<input type="text" name="email" value="${vendedor.email ?vendedor.email :''}" id="email" />
            <br />
            `;

            str+=`
            <label for="concessionaria">concessionaria</label>
            <select id="concessionaria">
            `;

            for(const item of concessionaria){
                str+=`<option id="${item.idconcessionaria}">${item.nomefantasia}</option>`;
            };

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
            if(!vendedor.idvendedor){
                self.controller.salvar(event);
            }
            else{
                self.controller.update_item(vendedor.idvendedor,event);
            }
        }

        form.onreset = function(event){
            self.controller.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#idvendedor").value="";
        document.querySelector("#nome").value="";
        document.querySelector("#email").value="";
        document.querySelector("#concessionaria").value="";
    }

    getDatavendedor(){
        let vendedor = new Vendedor();
        if(!document.querySelector("#idvendedor").value);
            vendedor.idvendedor = document.querySelector("#idvendedor").value;
            vendedor.nome = document.querySelector("#nome").value;
            vendedor.email = document.querySelector("#email").value;

            const sel = document.querySelector("#concessionaria");
            const opt = sel.options[sel.selectedIndex];
            vendedor.concessionaria = new Concessionaria(opt.value);
            vendedor.concessionaria.idconcessionaria = opt.id;

        return vendedor;        
    }

}