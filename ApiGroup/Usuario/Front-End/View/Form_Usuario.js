class Form_Usuario {

    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }

    montarForm(usuario){
        if(!usuario){
            usuario = new Usuario();
        }
        var str = `
        <h2>Formulario de Usuario</h2>
		<form action="" method="post" id="formulario">
			<label for="id">id</label>
			<input type="text" name="id" value="${usuario.id}" id="id" />
            <br />
			<label for="nome">nome</label>
			<input type="text" name="nome" value="${usuario.nome}" id="nome" />
			<br />
			<label for="login">login</label>
			<input type="text" name="login" value="${usuario.login}" id="login" />
			<br />
			<label for="senha">senha</label>
			<input type="text" name="senha" value="${usuario.senha}" id="senha" />
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
            if(!usuario.id){
                self.controller.salvar(event);
            }
            else{
                self.controller.update_item(usuario.id,event);
            }
        }

        form.onreset = function(event){
            self.controller.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#id").value="";
        document.querySelector("#nome").value="";
        document.querySelector("#login").value="";
        document.querySelector("#senha").value="";
    }

    getDatausuario(){
        let usuario = new Usuario();
        if(!document.querySelector("#id").value);
            usuario.chassi = document.querySelector("#id").value;
            usuario.modelo = document.querySelector("#nome").value;
            usuario.versao = document.querySelector("#login").value;
            usuario.cor = document.querySelector("#senha").value;

        return usuario;        
    }

}