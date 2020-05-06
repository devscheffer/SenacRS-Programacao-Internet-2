<?php
    include_once __DIR__.'\..\OBJ\objVersao.php';
    include_once __DIR__.'\..\PDOFactory.php';

    class VersaoDAO
    {
        public function insert(Versao $Versao)
        {
            $qInsert = "INSERT INTO 
            plversao(idversao, idmodelo, descversao)
            VALUES (
                :idversao
                ,:idmodelo
                ,:descversao
            )";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInsert);

            $comando->bindParam(":idversao",$Versao->idversao);
            $comando->bindParam(":idmodelo",$Versao->idmodelo);
            $comando->bindParam(":descversao",$Versao->descversao);


            $comando->execute();
            //$Versao->id = $pdo->lastInsertId();
            return $Versao;
        }

        public function delete($idversao)
        {
            $qDelete = "DELETE from 
            plversao 
            WHERE idversao=:idversao";            
            $Versao = $this->SearchByVersao($idversao);

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);

            $comando->bindParam(":idversao",$idversao);

            $comando->execute();
            return $Versao;
        }

        public function update(Versao $Versao)
        {
            $qUpdate = "UPDATE 
            plversao 
            SET 
                idversao=:idversao
                ,idmodelo=:idmodelo
                ,descversao=:descversao
                WHERE idversao=:idversao";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qUpdate);

            $comando->bindParam(":idversao",$Versao->idversao);
            $comando->bindParam(":idmodelo",$Versao->idmodelo);
            $comando->bindParam(":descversao",$Versao->descversao);


            $comando->execute();    
            return($Versao);    
        }

        public function list()
        {
            $query = 'SELECT * FROM plversao';
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $Versaos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $Versaos[] = new Versao(
                    $row->idversao
                    ,$row->idmodelo
                    ,$row->descversao
                );
            }
            return $Versaos;
        }

        public function SearchByVersao($idversao)
        {

             $query = 'SELECT * FROM plversao WHERE idversao=:idversao';
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('idversao', $idversao);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new Versao(
                $result->idversao
                ,$result->idmodelo
                ,$result->descversao
            );           
        }
    }
?>