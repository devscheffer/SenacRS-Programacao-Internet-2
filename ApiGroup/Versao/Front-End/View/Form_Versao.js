class Form_Versao {

    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }

    montarForm(versao){
        if(!versao){
            versao = new Versao();

        }
        var str = `
        <h2>Formulario de Versao</h2>
		<form action="" method="post" id="formulario">
			<label for="idversao">idversao</label>
			<input type="text" name="idversao" value="${versao.idversao}" id="idversao" />
            <br />
			<label for="idmodelo">idmodelo</label>
			<input type="text" name="idmodelo" value="${versao.idmodelo}" id="idmodelo" />
			<br />
			<label for="descversao">descversao</label>
			<input type="text" name="descversao" value="${versao.descversao}" id="descversao" />
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
            if(!versao.chassi){
                self.controller.salvar(event);
            }
            else{
                self.controller.update_item(versao.chassi,event);
            }
        }

        form.onreset = function(event){
            self.controller.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#idversao").value="";
        document.querySelector("#idmodelo").value="";
        document.querySelector("#descversao").value="";
    }

    getDataversao(){
        let versao = new Versao();
        if(!document.querySelector("#idversao").value);
            versao.chassi = document.querySelector("#idversao").value;
            versao.modelo = document.querySelector("#idmodelo").value;
            versao.versao = document.querySelector("#descversao").value;

        return versao;        
    }

}