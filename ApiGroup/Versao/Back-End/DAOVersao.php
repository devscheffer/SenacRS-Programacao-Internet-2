<?php
    include_once __DIR__.'\objversao.php';
    include_once __DIR__.'\..\..\..\PDOFactory.php';

    class VersaoDAO
    {
        public function insert(versao $versao)
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

            $comando->bindParam(":idversao",$versao->idversao);
            $comando->bindParam(":idmodelo",$versao->idmodelo);
            $comando->bindParam(":descversao",$versao->descversao);


            $comando->execute();
            //$versao->id = $pdo->lastInsertId();
            return $versao;
        }

        public function delete($idversao)
        {
            $qDelete = "DELETE from 
            plversao 
            WHERE idversao=:idversao";            
            $versao = $this->SearchByversao($idversao);

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);

            $comando->bindParam(":idversao",$idversao);

            $comando->execute();
            return $versao;
        }

        public function update(versao $versao)
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

            $comando->bindParam(":idversao",$versao->idversao);
            $comando->bindParam(":idmodelo",$versao->idmodelo);
            $comando->bindParam(":descversao",$versao->descversao);


            $comando->execute();    
            return($versao);    
        }

        public function list()
        {
            $query = 'SELECT * FROM plversao';
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $versaos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrversao[] = new versao(
                    $row->idversao
                    ,$row->idmodelo
                    ,$row->descversao
                );
            }
            return $arrversao;
        }

        public function SearchByversao($idversao)
        {

             $query = 'SELECT * FROM plversao WHERE idversao=:idversao';
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':idversao', $idversao);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new versao(
                $result->idversao
                ,$result->idmodelo
                ,$result->descversao
            );           
        }
    }
?>