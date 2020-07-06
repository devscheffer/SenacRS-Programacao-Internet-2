<?php
    include_once __DIR__.'\objVenda.php';
    include_once __DIR__.'\..\..\..\PDOFactory.php';

    class VendaDAO
    {
        public function insert(Venda $Venda)
        {
            $qInsert = "INSERT INTO 
            venda(idsale, concessionaria, vendedor, chassi, data, valor)
            VALUES (
                :idsale
                ,:concessionaria
                ,:vendedor
                ,:chassi
                ,:data
                ,:valor
            )";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInsert);

            $comando->bindParam(":idsale",$Venda->idsale);
            $comando->bindParam(":concessionaria",$Venda->concessionaria);
            $comando->bindParam(":vendedor",$Venda->vendedor);
            $comando->bindParam(":chassi",$Venda->chassi);
            $comando->bindParam(":data",$Venda->data);
            $comando->bindParam(":valor",$Venda->valor);

            $comando->execute();
            //$Venda->id = $pdo->lastInsertId();
            return $Venda;
        }

        public function delete($idsale)
        {
            $qDelete = "DELETE from 
            venda 
            WHERE idsale=:idsale";            
            $Venda = $this->SearchByID($idsale);

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDelete);

            $comando->bindParam(":idsale",$idsale);

            $comando->execute();
            return $Venda;
        }

        public function update(Venda $Venda)
        {
            $qUpdate = "UPDATE 
            venda 
            SET 
                idsale=:idsale
                ,concessionaria=:concessionaria
                ,vendedor=:vendedor
                ,chassi=:chassi
                ,data=:data
                ,valor=:valor
                WHERE idsale=:idsale";

            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qUpdate);

            $comando->bindParam(":idsale",$Venda->idsale);
            $comando->bindParam(":concessionaria",$Venda->concessionaria);
            $comando->bindParam(":vendedor",$Venda->vendedor);
            $comando->bindParam(":chassi",$Venda->chassi);
            $comando->bindParam(":data",$Venda->data);
            $comando->bindParam(":valor",$Venda->valor);

            $comando->execute();    
            return($Venda);    
        }

        public function list()
        {
            $query = 'SELECT * FROM venda';
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $Vendas=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrVenda[] = new Venda(
                    $row->idsale
                    ,$row->concessionaria
                    ,$row->vendedor
                    ,$row->chassi
                    ,$row->data
                    ,$row->valor
                );
            }
            return $arrVenda;
        }

        public function SearchByID($idsale)
        {

             $query = 'SELECT * FROM venda WHERE idsale=:idsale';
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':idsale', $idsale);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new Venda(
                $result->idsale
                ,$result->concessionaria
                ,$result->vendedor
                ,$result->chassi
                ,$result->data
                ,$result->valor
            );           
        }
    }
?>