<?php
    include_once __DIR__.'\..\OBJ\objCor.php';
    include_once __DIR__.'\..\PDOFactory.php';

    class CorDAO
    {
        public function insert(Cor $Cor)
        {
            $qInsert = "INSERT INTO 
            plcor(idcor, desccor)
            VALUES (
                :idcor
                ,:desccor
            )";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInsert);

            $comando->bindParam(":idcor",$Cor->idcor);
            $comando->bindParam(":desccor",$Cor->desccor);

            $comando->execute();
            //$Cor->id = $pdo->lastInsertId();
            return $Cor;
        }

        public function delete($idcor)
        {
            $qDelete = "DELETE from 
            plcor 
            WHERE idcor=:idcor";            
            $Cor = $this->SearchByCor($idcor);

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);

            $comando->bindParam(":idcor",$idcor);

            $comando->execute();
            return $Cor;
        }

        public function update(Cor $Cor)
        {
            $qUpdate = "UPDATE 
            plcor 
            SET 
                idcor=:idcor
                ,desccor=:desccor
                WHERE idcor=:idcor";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qUpdate);

            $comando->bindParam(":idcor",$Cor->idcor);
            $comando->bindParam(":desccor",$Cor->desccor);

            $comando->execute();    
            return($Cor);    
        }

        public function list()
        {
            $query = 'SELECT * FROM plcor';
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $Cors=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $Cors[] = new Cor(
                    $row->idcor
                    ,$row->desccor
                );
            }
            return $Cor;
        }

        public function SearchByCor($idcor)
        {

             $query = 'SELECT * FROM plcor WHERE idcor=:idcor';
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('idcor', $idcor);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new Cor(
                $result->idcor
                ,$result->desccor
            );           
        }
    }
?>