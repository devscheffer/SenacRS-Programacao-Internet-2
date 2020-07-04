class Form_Venda {

    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }

    montarForm(venda){
        if(!venda){
            venda = new Venda();
        }
        var str = `
        <h2>Formulario de Venda</h2>
		<form action="" method="post" id="formulario">
			<label for="idsale">idsale</label>
			<input type="text" name="idsale" value="${venda.idsale}" id="idsale" />
            <br />
			<label for="concessionaria">concessionaria</label>
			<input type="text" name="concessionaria" value="${venda.concessionaria}" id="concessionaria" />
			<br />
			<label for="vendedor">vendedor</label>
			<input type="text" name="vendedor" value="${venda.vendedor}" id="vendedor" />
			<br />
			<label for="chassi">chassi</label>
			<input type="text" name="chassi" value="${venda.chassi}" id="chassi" />
            <br />
			<label for="data">data</label>
			<input type="text" name="data" value="${venda.data}" id="data" />
            <br />
			<label for="valor">valor</label>
			<input type="text" name="valor" value="${venda.valor}" id="valor" />
			<br />
			<input type="submit" value="Salvar" />
			<input type="reset" value="Cancelar" />
		</form>
        `;

        let containerForm = document.querySelector(this.seletor);
        containerForm.innerHTML = str;

        var form = document.querySelector("#formulario");
        const self = this;
        form.onsubmit = function(event){
            if(!venda.idsale){
                self.controller.salvar(event);
            }
            else{
                self.controller.editar(venda.idsale,event);
            }
        }

        form.onreset = function(event){
            self.controller.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#idsale").value="";
        document.querySelector("#concessionaria").value="";
        document.querySelector("#vendedor").value="";
        document.querySelector("#chassi").value="";
        document.querySelector("#data").value="";
        document.querySelector("#valor").value="";

    }

    getDatavenda(){
        let venda = new Venda();
        if(!document.querySelector("#idsale").value);
            venda.idsale = document.querySelector("#idsale").value;
            venda.concessionaria = document.querySelector("#concessionaria").value;
            venda.vendedor = document.querySelector("#vendedor").value;
            venda.chassi = document.querySelector("#chassi").value;
            venda.data = document.querySelector("#data").value;
            venda.valor = document.querySelector("#valor").value;


        return venda;        
    }

}