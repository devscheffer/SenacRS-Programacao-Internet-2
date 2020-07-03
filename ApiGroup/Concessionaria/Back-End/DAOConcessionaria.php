<?php
    include_once __DIR__.'\objconcessionaria.php';
    include_once __DIR__.'\..\..\..\PDOFactory.php';

    class ConcessionariaDAO
    {
        public function insert(concessionaria $concessionaria)
        {
            $qInsert = "INSERT INTO 
            plconcessionaria(idconcessionaria, nomefantasia, uf, municipio)
            VALUES (
                :idconcessionaria
                ,:nomefantasia
                ,:uf
                ,:municipio
            )";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInsert);

            $comando->bindParam(":idconcessionaria",$concessionaria->idconcessionaria);
            $comando->bindParam(":nomefantasia",$concessionaria->nomefantasia);
            $comando->bindParam(":uf",$concessionaria->uf);
            $comando->bindParam(":municipio",$concessionaria->municipio);

            $comando->execute();
            //$concessionaria->id = $pdo->lastInsertId();
            return $concessionaria;
        }

        public function delete($idconcessionaria)
        {
            $qDelete = "DELETE from 
            plconcessionaria 
            WHERE idconcessionaria=:idconcessionaria";            
            $concessionaria = $this->SearchByconcessionaria($idconcessionaria);

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);

            $comando->bindParam(":idconcessionaria",$idconcessionaria);

            $comando->execute();
            return $concessionaria;
        }

        public function update(concessionaria $concessionaria)
        {
            $qUpdate = "UPDATE 
            plconcessionaria 
            SET 
                idconcessionaria=:idconcessionaria
                ,nomefantasia=:nomefantasia
                ,uf=:uf
                ,municipio=:municipio
                WHERE idconcessionaria=:idconcessionaria";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qUpdate);

            $comando->bindParam(":idconcessionaria",$concessionaria->idconcessionaria);
            $comando->bindParam(":nomefantasia",$concessionaria->nomefantasia);
            $comando->bindParam(":uf",$concessionaria->uf);
            $comando->bindParam(":municipio",$concessionaria->municipio);

            $comando->execute();    
            return($concessionaria);    
        }

        public function list()
        {
            $query = 'SELECT * FROM plconcessionaria';
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $concessionarias=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrconcessionaria[] = new concessionaria(
                    $row->idconcessionaria
                    ,$row->nomefantasia
                    ,$row->uf
                    ,$row->municipio
                );
            }
            return $arrconcessionaria;
        }

        public function SearchByconcessionaria($idconcessionaria)
        {

             $query = 'SELECT * FROM plconcessionaria WHERE idconcessionaria=:idconcessionaria';
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':idconcessionaria', $idconcessionaria);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new concessionaria(
                $result->idconcessionaria
                ,$result->nomefantasia
                ,$result->uf
                ,$result->municipio
            );           
        }
    }
?>