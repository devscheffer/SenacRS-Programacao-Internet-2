<?php
    include_once __DIR__.'\..\OBJ\objModelo.php';
    include_once __DIR__.'\..\PDOFactory.php';

    class ModeloDAO
    {
        public function insert(Modelo $Modelo)
        {
            $qInsert = "INSERT INTO 
            plmodelo(idmodelo, descmodelo)
            VALUES (
                :idmodelo
                ,:descmodelo
            )";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInsert);

            $comando->bindParam(":idmodelo",$Modelo->idmodelo);
            $comando->bindParam(":descmodelo",$Modelo->descmodelo);

            $comando->execute();
            //$Modelo->id = $pdo->lastInsertId();
            return $Modelo;
        }

        public function delete($idmodelo)
        {
            $qDelete = "DELETE from 
            plmodelo 
            WHERE idmodelo=:idmodelo";            
            $Modelo = $this->SearchByModelo($idmodelo);

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);

            $comando->bindParam(":idmodelo",$idmodelo);

            $comando->execute();
            return $Modelo;
        }

        public function update(Modelo $Modelo)
        {
            $qUpdate = "UPDATE 
            plmodelo 
            SET 
                idmodelo=:idmodelo
                ,descmodelo=:descmodelo
                WHERE idmodelo=:idmodelo";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qUpdate);

            $comando->bindParam(":idmodelo",$Modelo->idmodelo);
            $comando->bindParam(":descmodelo",$Modelo->descmodelo);

            $comando->execute();    
            return($Modelo);    
        }

        public function list()
        {
            $query = 'SELECT * FROM plmodelo';
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $Modelos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrModelo[] = new Modelo(
                    $row->idmodelo
                    ,$row->descmodelo
                );
            }
            return $arrModelo;
        }

        public function SearchByModelo($idmodelo)
        {

             $query = 'SELECT * FROM plmodelo WHERE idmodelo=:idmodelo';
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('idmodelo', $idmodelo);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new Cor(
                $result->idmodelo
                ,$result->descmodelo
            );           
        }
    }
?>