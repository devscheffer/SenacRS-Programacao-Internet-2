class APIService_Usuario {
	uri = "http://localhost:8000/api/usuario";

	create_item(usuario, ok, erro){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState === 4){ 
				if(this.status === 201) { 
					ok(this.responseText);
				}
				else {
					erro(this.status);
				}
			}
		};
		xhttp.open("POST", this.uri, true);
		xhttp.setRequestHeader("Content-Type","application/json");
		xhttp.send(JSON.stringify(usuario));
		
	}

	read_item_all(ok, erro) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState === 4) {
				if(this.status === 200) {
					//Chama o método sucesso definido no carregarusuario() do controller
					ok(JSON.parse(this.responseText));
				}
				else {
					//Chama o método trataErro definido no carregarusuario() do controller
					erro(this.status);
				}
			}
		};
		xhttp.open("GET", this.uri, true);
		xhttp.send();
	}

	read_item_id(id,ok,error) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState === 4 && this.status === 200) {
				ok(JSON.parse(this.responseText));          
			}
			else if(this.status !== 200){
				error(this.status);
			}
		};
		xhttp.open("GET", this.uri+'/'+id, true);
		xhttp.send();
	}

	update_item_id(id,usuario,ok,error) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState === 4 && this.status === 200) {
				ok(JSON.parse(this.responseText));          
			}
			else if(this.status !== 200){
				error(this.status);
			}
		};
		xhttp.open("PUT", this.uri+'/'+id, true);
		xhttp.setRequestHeader("Content-Type","application/json")
		xhttp.send(JSON.stringify(usuario));
	}

	delete_item_id(id,ok,error) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState === 4 && this.status === 200) {
				ok(JSON.parse(this.responseText));          
			}
			else if(this.status !== 200){
				error(this.status);
			}
		};
		xhttp.open("DELETE", this.uri+'/'+id, true);
		xhttp.send();
	}
}