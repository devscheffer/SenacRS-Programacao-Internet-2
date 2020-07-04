<?php
    include_once __DIR__.'\objvendedor.php';
    include_once __DIR__.'\..\..\..\PDOFactory.php';

    class VendedorDAO
    {
        public function insert(vendedor $vendedor)
        {
            $qInsert = "INSERT INTO 
            plvendedor(idvendedor, nome, email, concessionaria)
            VALUES (
                :idvendedor
                ,:nome
                ,:email
                ,:concessionaria
            )";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInsert);

            $comando->bindParam(":idvendedor",$vendedor->idvendedor);
            $comando->bindParam(":nome",$vendedor->nome);
            $comando->bindParam(":email",$vendedor->email);
            $comando->bindParam(":concessionaria",$vendedor->concessionaria);

            $comando->execute();
            //$vendedor->id = $pdo->lastInsertId();
            return $vendedor;
        }

        public function delete($idvendedor)
        {
            $qDelete = "DELETE from 
            plvendedor 
            WHERE idvendedor=:idvendedor";            
            $vendedor = $this->SearchByvendedor($idvendedor);

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);

            $comando->bindParam(":idvendedor",$idvendedor);

            $comando->execute();
            return $vendedor;
        }

        public function update(vendedor $vendedor)
        {
            $qUpdate = "UPDATE 
            plvendedor 
            SET 
                idvendedor=:idvendedor
                ,nome=:nome
                ,email=:email
                ,concessionaria=:concessionaria
                WHERE idvendedor=:idvendedor";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qUpdate);

            $comando->bindParam(":idvendedor",$vendedor->idvendedor);
            $comando->bindParam(":nome",$vendedor->nome);
            $comando->bindParam(":email",$vendedor->email);
            $comando->bindParam(":concessionaria",$vendedor->concessionaria);

            $comando->execute();    
            return($vendedor);    
        }

        public function list()
        {
            $query = 'SELECT * FROM plvendedor';
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $vendedors=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrvendedor[] = new vendedor(
                    $row->idvendedor
                    ,$row->nome
                    ,$row->email
                    ,$row->concessionaria
                );
            }
            return $arrvendedor;
        }

        public function SearchByvendedor($idvendedor)
        {

             $query = 'SELECT * FROM plvendedor WHERE idvendedor=:idvendedor';
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':idvendedor', $idvendedor);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new vendedor(
                $result->idvendedor
                ,$result->nome
                ,$result->email
                ,$result->concessionaria
            );           
        }
    }
?>