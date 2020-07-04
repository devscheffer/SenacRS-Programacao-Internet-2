class Form_Vendedor {

    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }

    montarForm(vendedor){
        if(!vendedor){
            vendedor = new Vendedor();
        }
        var str = `
        <h2>Formulario de Vendedor</h2>
		<form action="" method="post" id="formulario">
			<label for="idvendedor">idvendedor</label>
			<input type="text" name="idvendedor" value="${vendedor.idvendedor}" id="idvendedor" />
            <br />
			<label for="nome">nome</label>
			<input type="text" name="nome" value="${vendedor.nome}" id="nome" />
			<br />
			<label for="email">email</label>
			<input type="text" name="email" value="${vendedor.email}" id="email" />
			<br />
			<label for="concessionaria">concessionaria</label>
			<input type="text" name="concessionaria" value="${vendedor.concessionaria}" id="concessionaria" />
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
            if(!vendedor.idvendedor){
                self.controller.salvar(event);
            }
            else{
                self.controller.editar(vendedor.idvendedor,event);
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
            vendedor.concessionaria = document.querySelector("#concessionaria").value;

        return vendedor;        
    }

}