<?php
    include_once __DIR__.'\objmodelo.php';
    include_once __DIR__.'\..\..\..\PDOFactory.php';

    class ModeloDAO
    {
        public function insert(modelo $modelo)
        {
            $qInsert = "INSERT INTO 
            plmodelo(idmodelo, descmodelo)
            VALUES (
                :idmodelo
                ,:descmodelo
            )";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInsert);

            $comando->bindParam(":idmodelo",$modelo->idmodelo);
            $comando->bindParam(":descmodelo",$modelo->descmodelo);

            $comando->execute();
            //$modelo->id = $pdo->lastInsertId();
            return $modelo;
        }

        public function delete($idmodelo)
        {
            $qDelete = "DELETE from 
            plmodelo 
            WHERE idmodelo=:idmodelo";            
            $modelo = $this->SearchByID($idmodelo);

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);

            $comando->bindParam(":idmodelo",$idmodelo);

            $comando->execute();
            return $modelo;
        }

        public function update(modelo $modelo)
        {
            $qUpdate = "UPDATE 
            plmodelo 
            SET 
                idmodelo=:idmodelo
                ,descmodelo=:descmodelo
                WHERE idmodelo=:idmodelo";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qUpdate);

            $comando->bindParam(":idmodelo",$modelo->idmodelo);
            $comando->bindParam(":descmodelo",$modelo->descmodelo);

            $comando->execute();    
            return($modelo);    
        }

        public function list()
        {
            $query = 'SELECT * FROM plmodelo';
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $modelos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrmodelo[] = new modelo(
                    $row->idmodelo
                    ,$row->descmodelo
                );
            }
            return $arrmodelo;
        }

        public function SearchByID($idmodelo)
        {

             $query = 'SELECT * FROM plmodelo WHERE idmodelo=:idmodelo';
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':idmodelo', $idmodelo);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new Modelo(
                $result->idmodelo
                ,$result->descmodelo
            );           
        }
    }
?>