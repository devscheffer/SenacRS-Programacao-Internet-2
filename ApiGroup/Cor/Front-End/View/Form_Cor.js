class Form_Cor {

    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }

    montarForm(cor){
        if(!cor){
            cor = new Cor();
        }
        var str = `
        <h2>Formulario de Cor</h2>
		<form action="" method="post" id="formulario">
			<label for="idcor">idcor</label>
			<input type="text" name="idcor" value="${cor.idcor}" id="idcor" />
            <br />
			<label for="desccor">desccor</label>
			<input type="text" name="desccor" value="${cor.desccor}" id="desccor" />
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
            if(!cor.idcor){
                self.controller.salvar(event);
            }
            else{
                self.controller.editar(cor.idcor,event);
            }
        }

        form.onreset = function(event){
            self.controller.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#idcor").value="";
        document.querySelector("#desccor").value="";
    }

    getDatacor(){
        let cor = new Cor();
        if(!document.querySelector("#idcor").value);
            cor.idcor = document.querySelector("#idcor").value;
            cor.desccor = document.querySelector("#desccor").value;

        return cor;        
    }

}