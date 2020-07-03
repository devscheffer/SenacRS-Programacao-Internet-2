<?php
    include_once __DIR__.'\objcor.php';
    include_once __DIR__.'\..\..\..\PDOFactory.php';

    class CorDAO
    {
        public function insert(cor $cor)
        {
            $qInsert = "INSERT INTO 
            plcor(idcor, desccor)
            VALUES (
                :idcor
                ,:desccor
            )";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInsert);

            $comando->bindParam(":idcor",$cor->idcor);
            $comando->bindParam(":desccor",$cor->desccor);

            $comando->execute();
            //$cor->id = $pdo->lastInsertId();
            return $cor;
        }

        public function delete($idcor)
        {
            $qDelete = "DELETE from 
            plcor 
            WHERE idcor=:idcor";            
            $cor = $this->SearchBycor($idcor);

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);

            $comando->bindParam(":idcor",$idcor);

            $comando->execute();
            return $cor;
        }

        public function update(cor $cor)
        {
            $qUpdate = "UPDATE 
            plcor 
            SET 
                idcor=:idcor
                ,desccor=:desccor
                WHERE idcor=:idcor";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qUpdate);

            $comando->bindParam(":idcor",$cor->idcor);
            $comando->bindParam(":desccor",$cor->desccor);

            $comando->execute();    
            return($cor);    
        }

        public function list()
        {
            $query = 'SELECT * FROM plcor';
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $cors=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrcor[] = new cor(
                    $row->idcor
                    ,$row->desccor
                );
            }
            return $arrcor;
        }

        public function SearchBycor($idcor)
        {

             $query = 'SELECT * FROM plcor WHERE idcor=:idcor';
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':idcor', $idcor);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new cor(
                $result->idcor
                ,$result->desccor
            );           
        }
    }
?>