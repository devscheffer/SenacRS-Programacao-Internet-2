<?php
    include_once __DIR__.'\..\OBJ\objCarro.php';
    include_once __DIR__.'\..\PDOFactory.php';

    class CarroDAO
    {
        public function insert(Carro $Carro)
        {
            $qInsert = "INSERT INTO 
            plchassi(chassi, modelo, versao, cor)
            VALUES (
                :chassi
                ,:modelo
                ,:versao
                ,:cor
            )";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInsert);

            $comando->bindParam(":chassi",$Carro->chassi);
            $comando->bindParam(":modelo",$Carro->modelo);
            $comando->bindParam(":versao",$Carro->versao);
            $comando->bindParam(":cor",$Carro->cor);

            $comando->execute();
            //$Carro->id = $pdo->lastInsertId();
            return $Carro;
        }

        public function delete($Chassi)
        {
            $qDelete = "DELETE from 
            plchassi 
            WHERE chassi=:chassi";            
            $Carro = $this->SearchByChassi($Chassi);

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);

            $comando->bindParam(":chassi",$Chassi);

            $comando->execute();
            return $Carro;
        }

        public function update(Carro $Carro)
        {
            $qUpdate = "UPDATE 
            plchassi 
            SET 
                chassi=:chassi
                ,modelo=:modelo
                ,versao=:versao
                ,cor=:cor
                WHERE chassi=:chassi";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qUpdate);

            $comando->bindParam(":chassi",$Carro->chassi);
            $comando->bindParam(":modelo",$Carro->modelo);
            $comando->bindParam(":versao",$Carro->versao);
            $comando->bindParam(":cor",$Carro->cor);

            $comando->execute();    
            return($Carro);    
        }

        public function list()
        {
            $query = 'SELECT * FROM plchassi';
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $Carros=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $Carros[] = new Carro(
                    $row->chassi
                    ,$row->modelo
                    ,$row->versao
                    ,$row->cor
                );
            }
            return $Carros;
        }

        public function SearchByChassi($Chassi)
        {

             $query = 'SELECT * FROM plchassi WHERE chassi=:chassi';
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('chassi', $Chassi);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new Carro(
                $result->chassi
                ,$result->modelo
                ,$result->versao
                ,$result->cor
            );           
        }
    }
?>