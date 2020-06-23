<?php
    include_once __DIR__.'\objcarro.php';
    include_once __DIR__.'\..\..\..\PDOFactory.php';

    class CarroDAO
    {
        public function insert(carro $carro)
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

            $comando->bindParam(":chassi",$carro->chassi);
            $comando->bindParam(":modelo",$carro->modelo);
            $comando->bindParam(":versao",$carro->versao);
            $comando->bindParam(":cor",$carro->cor);

            $comando->execute();
            
            return $carro;
        }

        public function delete($chassi)
        {
            $qDelete = "DELETE from 
            plchassi 
            WHERE chassi=:chassi";            
            $carro = $this->SearchBychassi($chassi);

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);

            $comando->bindParam(":chassi",$chassi);

            $comando->execute();
            return $carro;
        }

        public function update(carro $carro)
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

            $comando->bindParam(":chassi",$carro->chassi);
            $comando->bindParam(":modelo",$carro->modelo);
            $comando->bindParam(":versao",$carro->versao);
            $comando->bindParam(":cor",$carro->cor);

            $comando->execute();    
            return($carro);    
        }

        public function list()
        {
            $query = 'SELECT * FROM plchassi';
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $carros=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrcarro[] = new carro(
                    $row->chassi
                    ,$row->modelo
                    ,$row->versao
                    ,$row->cor
                );
            }
            return $arrcarro;
        }

        public function SearchBychassi($chassi)
        {

             $query = 'SELECT * FROM plchassi WHERE chassi=:chassi';
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':chassi', $chassi);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new carro(
                $result->chassi
                ,$result->modelo
                ,$result->versao
                ,$result->cor
            );           
        }
    }
?>