class Form_Concessionaria {

    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }

    montarForm(concessionaria){
        if(!concessionaria){
            concessionaria = new Concessionaria();
        }
        var str = `
        <h2>Formulario de Concessionaria</h2>
		<form action="" method="post" id="formulario">
			<label for="idconcessionaria">idconcessionaria</label>
			<input type="text" name="idconcessionaria" value="${concessionaria.idconcessionaria}" id="idconcessionaria" />
            <br />
			<label for="nomefantasia">nomefantasia</label>
			<input type="text" name="nomefantasia" value="${concessionaria.nomefantasia}" id="nomefantasia" />
			<br />
			<label for="uf">uf</label>
			<input type="text" name="uf" value="${concessionaria.uf}" id="uf" />
			<br />
			<label for="municipio">municipio</label>
			<input type="text" name="municipio" value="${concessionaria.municipio}" id="municipio" />
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
            if(!concessionaria.idconcessionaria){
                self.controller.salvar(event);
            }
            else{
                self.controller.editar(concessionaria.idconcessionaria,event);
            }
        }

        form.onreset = function(event){
            self.controller.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#idconcessionaria").value="";
        document.querySelector("#nomefantasia").value="";
        document.querySelector("#uf").value="";
        document.querySelector("#municipio").value="";
    }

    getDataconcessionaria(){
        let concessionaria = new Concessionaria();
        if(!document.querySelector("#idconcessionaria").value);
            concessionaria.idconcessionaria = document.querySelector("#idconcessionaria").value;
            concessionaria.nomefantasia = document.querySelector("#nomefantasia").value;
            concessionaria.uf = document.querySelector("#uf").value;
            concessionaria.municipio = document.querySelector("#municipio").value;

        return concessionaria;        
    }

}