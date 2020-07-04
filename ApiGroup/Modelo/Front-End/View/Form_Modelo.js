class Form_Modelo {

    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }

    montarForm(modelo){
        if(!modelo){
            modelo = new Modelo();
        }
        var str = `
        <h2>Formulario de Modelo</h2>
		<form action="" method="post" id="formulario">
			<label for="idmodelo">idmodelo</label>
			<input type="text" name="idmodelo" value="${modelo.idmodelo}" id="idmodelo" />
            <br />
			<label for="descmodelo">descmodelo</label>
			<input type="text" name="descmodelo" value="${modelo.descmodelo}" id="descmodelo" />
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
            if(!modelo.idmodelo){
                self.controller.salvar(event);
            }
            else{
                self.controller.update_item(modelo.idmodelo,event);
            }
        }

        form.onreset = function(event){
            self.controller.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#idmodelo").value="";
        document.querySelector("#descmodelo").value="";

    }

    getDatamodelo(){
        let modelo = new Modelo();
        if(!document.querySelector("#idmodelo").value);
            modelo.idmodelo = document.querySelector("#idmodelo").value;
            modelo.descmodelo = document.querySelector("#descmodelo").value;

        return modelo;        
    }

}