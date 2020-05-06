<?php
    include_once __DIR__.'\..\OBJ\objConcessionaria.php';
    include_once __DIR__.'\..\PDOFactory.php';

    class ConcessionariaDAO
    {
        public function insert(Concessionaria $Concessionaria)
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

            $comando->bindParam(":idconcessionaria",$Concessionaria->chassi);
            $comando->bindParam(":nomefantasia",$Concessionaria->modelo);
            $comando->bindParam(":uf",$Concessionaria->versao);
            $comando->bindParam(":municipio",$Concessionaria->cor);

            $comando->execute();
            //$Concessionaria->id = $pdo->lastInsertId();
            return $Concessionaria;
        }

        public function delete($idconcessionaria)
        {
            $qDelete = "DELETE from 
            plconcessionaria 
            WHERE idconcessionaria=:idconcessionaria";            
            $Concessionaria = $this->SearchByConcessionaria($idconcessionaria);

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);

            $comando->bindParam(":idconcessionaria",$idconcessionaria);

            $comando->execute();
            return $Concessionaria;
        }

        public function update(Concessionaria $Concessionaria)
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

            $comando->bindParam(":idconcessionaria",$Concessionaria->idconcessionaria);
            $comando->bindParam(":nomefantasia",$Concessionaria->nomefantasia);
            $comando->bindParam(":uf",$Concessionaria->uf);
            $comando->bindParam(":municipio",$Concessionaria->municipio);

            $comando->execute();    
            return($Concessionaria);    
        }

        public function list()
        {
            $query = 'SELECT * FROM plconcessionaria';
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $Concessionarias=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $Concessionarias[] = new Concessionaria(
                    $row->idconcessionaria
                    ,$row->nomefantasia
                    ,$row->uf
                    ,$row->municipio
                );
            }
            return $Concessionarias;
        }

        public function SearchByConcessionaria($idconcessionaria)
        {

             $query = 'SELECT * FROM plconcessionaria WHERE idconcessionaria=:idconcessionaria';
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('idconcessionaria', $idconcessionaria);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new Concessionaria(
                $result->idconcessionaria
                ,$result->nomefantasia
                ,$result->uf
                ,$result->municipio
            );           
        }
    }
?>