<?php
    include_once __DIR__.'\objUsuario.php';
	include_once __DIR__.'\..\..\..\PDOFactory.php';

    class UsuarioDAO
    {
        public function insert(Usuario $usuario)
        {
            $qInsert = "INSERT INTO 
            usuario(nome,login,senha) 
            VALUES (
                :nome
                ,:login
                ,:senha
            )";
            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInsert);

            $comando->bindParam(":nome",$usuario->nome);
            $comando->bindParam(":login",$usuario->login);
            $comando->bindParam(":senha",$usuario->senha);

            $comando->execute();
            $usuario->id = $pdo->lastInsertId();
            return $usuario;
        }

        public function delete($id)
        {
            $qDelete = "DELETE from usuario WHERE id=:id";
            $usuario = $this->SearchByUserID($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $usuario;
        }

        public function update(Usuario $usuario)
        {
            $qUpdate = "UPDATE usuario 
            SET 
                nome=:nome
                , login=:login
                , senha=:senha 
            WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qUpdate);
            $comando->bindParam(":nome",$usuario->nome);
            $comando->bindParam(":login",$usuario->login);
            $comando->bindParam(":senha",$usuario->senha);
            $comando->bindParam(":id",$usuario->id);
            $comando->execute();
            return $usuario;        
        }

        public function list()
        {
		    $query = 'SELECT * FROM usuario';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $usuario=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $arrUsuario[] = new Usuario(
                    $row->id
                    ,$row->nome
                    ,$row->login
                    ,$row->senha
                );
            }
            return $arrUsuario;
        }

        public function SearchByUserID($id)
        {
 		    $query = 'SELECT * FROM usuario WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (':id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Usuario(
                $result->id
                ,$result->nome
                ,$result->login
                ,$result->senha
            );           
        }

        public function SearchByLogin($login)
        {
 		    $query = 'SELECT * FROM usuario WHERE login=:login';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (':login', $login);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Usuario(
                $result->id
                ,$result->nome
                ,$result->login
                ,$result->senha
            );           
        }
    }
?>