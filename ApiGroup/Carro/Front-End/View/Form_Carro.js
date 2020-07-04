class Form_Carro {

    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }

    montarForm(carro){
        if(!carro){
            carro = new Carro();
        }
        var str = `
        <h2>Formulario de Carro</h2>
		<form action="" method="post" id="formulario">
			<label for="chassi">chassi</label>
			<input type="text" name="chassi" value="${carro.chassi}" id="chassi" />
            <br />
			<label for="modelo">modelo</label>
			<input type="text" name="modelo" value="${carro.modelo}" id="modelo" />
			<br />
			<label for="versao">versao</label>
			<input type="text" name="versao" value="${carro.versao}" id="versao" />
			<br />
			<label for="cor">cor</label>
			<input type="text" name="cor" value="${carro.cor}" id="cor" />
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
        document.querySelector("#modelo").value="";
        document.querySelector("#versao").value="";
        document.querySelector("#cor").value="";
    }

    getDatacarro(){
        let carro = new Carro();
        if(!document.querySelector("#chassi").value);
            carro.chassi = document.querySelector("#chassi").value;
            carro.modelo = document.querySelector("#modelo").value;
            carro.versao = document.querySelector("#versao").value;
            carro.cor = document.querySelector("#cor").value;

        return carro;        
    }

}