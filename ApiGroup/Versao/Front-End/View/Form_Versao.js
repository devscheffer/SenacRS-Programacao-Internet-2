class Form_Versao {

    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }

    montarForm(modelo, versao){
        var str = `

        <h2>Formulario de Versao</h2>
		<form action="" method="post" id="formulario">
			<label for="idversao">idversao</label>
        `;

        if(!versao){
            versao = new Versao();
            str+=`
			<input type="text" name="idversao" value="${versao.idversao ?versao.idversao :''}" id="idversao" />

            `;

        }
        else{
            str+=`
			<input type="text" name="idversao" value="${versao.idversao ?versao.idversao :''}" id="idversao" readonly />
            `;
        }
        
        str += `
            <br />
            `

            str+=`
            <label for="descmodelo">descmodelo</label>
            <select id="descmodelo">
            `;

            for(const item of modelo){
                str+=`<option id="${item.idmodelo}">${item.descmodelo}</option>`;
            }

            str+=`
            </select>
            <br />
            `;

            str+=`
			<label for="descversao">descversao</label>
			<input type="text" name="descversao" value="${versao.descversao ?versao.descversao :''}" id="descversao" />
            `;

            str+=`<br />
			<input type="submit" value="Salvar" />
			<input type="reset" value="Cancelar" />
		</form>
        `;

        let containerForm = document.querySelector(this.seletor);
        containerForm.innerHTML = str;

        var form = document.querySelector("#formulario");
        const self = this;
        form.onsubmit = function(event){
            if(!versao.idversao){
                self.controller.salvar(event);
            }
            else{
                self.controller.update_item(versao.idversao,event);
            }
        }

        form.onreset = function(event){
            self.controller.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#idversao").value="";
        document.querySelector("#descversao").value="";
        document.querySelector("#descmodelo").value="";

    }

    getDataversao(){
        let versao = new Versao();
        if(!document.querySelector("#idversao").value);

            versao.idversao = document.querySelector("#idversao").value;
            versao.descversao = document.querySelector("#descversao").value;

            const sel = document.querySelector("#descmodelo");
            const opt = sel.options[sel.selectedIndex];
            versao.modelo = new Modelo(opt.value);
            versao.modelo.idmodelo = opt.id;

        return versao;        
    }

}

