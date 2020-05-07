<?php
    include_once __DIR__.'\..\OBJ\objVendedor.php';
    include_once __DIR__.'\..\PDOFactory.php';

    class VendedorDAO
    {
        public function insert(Vendedor $Vendedor)
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

            $comando->bindParam(":idvendedor",$Vendedor->idvendedor);
            $comando->bindParam(":nome",$Vendedor->nome);
            $comando->bindParam(":email",$Vendedor->email);
            $comando->bindParam(":concessionaria",$Vendedor->concessionaria);

            $comando->execute();
            //$Vendedor->id = $pdo->lastInsertId();
            return $Vendedor;
        }

        public function delete($idvendedor)
        {
            $qDelete = "DELETE from 
            plvendedor 
            WHERE idvendedor=:idvendedor";            
            $Vendedor = $this->SearchByVendedor($Chassi);

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);

            $comando->bindParam(":idvendedor",$idvendedor);

            $comando->execute();
            return $Vendedor;
        }

        public function update(Vendedor $Vendedor)
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

            $comando->bindParam(":idvendedor",$Vendedor->idvendedor);
            $comando->bindParam(":nome",$Vendedor->nome);
            $comando->bindParam(":email",$Vendedor->email);
            $comando->bindParam(":concessionaria",$Vendedor->concessionaria);

            $comando->execute();    
            return($Vendedor);    
        }

        public function list()
        {
            $query = 'SELECT * FROM plvendedor';
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $Vendedors=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrVendedor[] = new Vendedor(
                    $row->idvendedor
                    ,$row->nome
                    ,$row->email
                    ,$row->concessionaria
                );
            }
            return $arrVendedor;
        }

        public function SearchByVendedor($idvendedor)
        {

             $query = 'SELECT * FROM plvendedor WHERE idvendedor=:idvendedor';
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('idvendedor', $idvendedor);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new Vendedor(
                $result->idvendedor
                ,$result->nome
                ,$result->email
                ,$result->concessionaria
            );           
        }
    }
?>