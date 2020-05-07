<?php
    include_once __DIR__.'\..\OBJ\objRN2.php';
    include_once __DIR__.'\..\PDOFactory.php';

    class RN2DAO
    {
        public function list()
        {
            $query = "
            select 
                vendedor
                ,extract(year from data)::varchar(4) as ano
                ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                ,modelo
                ,count(*) as nModelo
                ,bonus
                ,count(*) * bonus as Comissao_Modelo
            from venda
            left join plchassi
                on venda.chassi = plchassi.chassi
            left join prmbonusmodelo
                on plchassi.modelo = prmbonusmodelo.idmodelo
            group by 
            vendedor
            ,ano
            ,mes
            ,modelo
            ,bonus
            ";
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
            $comando->execute();
            
            $RN2=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrRN2[] = new RN2(
                    $row->Vendedor
                    ,$row->Ano
                    ,$row->Mes
                    ,$row->Modelo
                    ,$row->NModelo
                    ,$row->Bonus
                    ,$row->Comissao_Modelo
                );
            }
            return $arrRN2;
        }

        public function SearchByVendedor($Vendedor)
        {

             $query = "
             select 
                vendedor
                ,extract(year from data)::varchar(4) as ano
                ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                ,modelo
                ,count(*) as nModelo
                ,bonus
                ,count(*) * bonus as Comissao_Modelo
            from venda
            left join plchassi
                on venda.chassi = plchassi.chassi
            left join prmbonusmodelo
                on plchassi.modelo = prmbonusmodelo.idmodelo
            group by 
            vendedor
            ,ano
            ,mes
            ,modelo
            ,bonus
            where vendedor =: vendedor
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('vendedor', $Vendedor);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new RN2(
                $result->Vendedor
                ,$result->Ano
                ,$result->Mes
                ,$result->Modelo
                ,$result->NModelo
                ,$result->Bonus
                ,$result->Comissao_Modelo
            );           
        }

        public function SearchByAno($Ano)
        {

             $query = "
             select 
                vendedor
                ,extract(year from data)::varchar(4) as ano
                ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                ,modelo
                ,count(*) as nModelo
                ,bonus
                ,count(*) * bonus as Comissao_Modelo
            from venda
            left join plchassi
                on venda.chassi = plchassi.chassi
            left join prmbonusmodelo
                on plchassi.modelo = prmbonusmodelo.idmodelo
            group by 
            vendedor
            ,ano
            ,mes
            ,modelo
            ,bonus
            where ano =: ano
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('ano', $Ano);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new RN2(
                $result->Vendedor
                ,$result->Ano
                ,$result->Mes
                ,$result->Modelo
                ,$result->NModelo
                ,$result->Bonus
                ,$result->Comissao_Modelo
            );                        
        }

        public function SearchByAnoMes($Ano,$Mes)
        {

             $query = "
             select 
                vendedor
                ,extract(year from data)::varchar(4) as ano
                ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                ,modelo
                ,count(*) as nModelo
                ,bonus
                ,count(*) * bonus as Comissao_Modelo
            from venda
            left join plchassi
                on venda.chassi = plchassi.chassi
            left join prmbonusmodelo
                on plchassi.modelo = prmbonusmodelo.idmodelo
            group by 
            vendedor
            ,ano
            ,mes
            ,modelo
            ,bonus
            where ano =: ano
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('ano', $Ano);
            $comando->bindParam ('mes', $Mes);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new RN2(
                $result->Vendedor
                ,$result->Ano
                ,$result->Mes
                ,$result->Modelo
                ,$result->NModelo
                ,$result->Bonus
                ,$result->Comissao_Modelo
            );                      
        }
    }
?>