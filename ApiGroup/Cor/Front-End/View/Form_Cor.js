class Form_Cor {

    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }

    montarForm(cor){
        console.log(cor);
        var str = `
        <h2>Formulario de Cor</h2>
		<form action="" method="post" id="formulario">
            <label for="idcor">idcor</label>
        `;

        if(!cor){
            cor = new Cor();
            str+=`
            <input type="text" name="idcor" value="${cor.idcor ?cor.idcor :''}" id="idcor" />
            `;
            
        }
        else{
            str+=`
            <input type="text" name="idcor" value="${cor.idcor}" id="idcor" readonly/>
            `;
        }
        
        
        str+=`
            <br />
			<label for="desccor">desccor</label>
			<input type="text" name="desccor" value="${cor.desccor ?cor.desccor :''}" id="desccor" />
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
                self.controller.update_item(cor.idcor,event);
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