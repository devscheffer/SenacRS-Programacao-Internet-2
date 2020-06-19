<?php
    include_once __DIR__.'\objRN2.php';
    include_once __DIR__.'\..\..\PDOFactory.php';

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
                ,count(*) as nmodelo
                ,bonus
                ,count(*) * bonus as comissao_modelo
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
                    $row->vendedor
                    ,$row->ano
                    ,$row->mes
                    ,$row->modelo
                    ,$row->nmodelo
                    ,$row->bonus
                    ,$row->comissao_modelo
                );
            }
            return $arrRN2;
        }

        public function SearchByvendedor($vendedor)
        {

             $query = "
             select 
                vendedor
                ,extract(year from data)::varchar(4) as ano
                ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                ,modelo
                ,count(*) as nmodelo
                ,bonus
                ,count(*) * bonus as comissao_modelo
            from venda
            left join plchassi
                on venda.chassi = plchassi.chassi
            left join prmbonusmodelo
                on plchassi.modelo = prmbonusmodelo.idmodelo
            where 
                vendedor =:vendedor
            group by 
                vendedor
                ,ano
                ,mes
                ,modelo
                ,bonus
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':vendedor', $vendedor);
            
		    $comando->execute();
            
            $RN2=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrRN2[] = new RN2(
                    $row->vendedor
                    ,$row->ano
                    ,$row->mes
                    ,$row->modelo
                    ,$row->nmodelo
                    ,$row->bonus
                    ,$row->comissao_modelo
                );
            }
            return $arrRN2;          
        }

        public function SearchByano($ano)
        {

             $query = "
            select 
                vendedor
                ,ano
                ,mes
                ,modelo
                ,nmodelo
                ,bonus
                ,comissao_modelo
            from (
                select 
                    vendedor
                    ,extract(year from data)::varchar(4) as ano
                    ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                    ,modelo
                    ,count(*) as nmodelo
                    ,bonus
                    ,count(*) * bonus as comissao_modelo
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
                ) as tab1
            where 
                ano =:ano
            
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':ano', $ano);
            
		    $comando->execute();
            
            $RN2=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrRN2[] = new RN2(
                    $row->vendedor
                    ,$row->ano
                    ,$row->mes
                    ,$row->modelo
                    ,$row->nmodelo
                    ,$row->bonus
                    ,$row->comissao_modelo
                );
            }
            return $arrRN2;                        
        }

        public function SearchByanomes($ano,$mes)
        {

             $query = "
             select 
                vendedor
                ,ano
                ,mes
                ,modelo
                ,nmodelo
                ,bonus
                ,comissao_modelo
            from (
                select 
                    vendedor
                    ,extract(year from data)::varchar(4) as ano
                    ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                    ,modelo
                    ,count(*) as nmodelo
                    ,bonus
                    ,count(*) * bonus as comissao_modelo
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
                ) as tab1
            where 
                ano =:ano
                and mes =:mes
            
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':ano', $ano);
            $comando->bindParam (':mes', $mes);
            
		    $comando->execute();
            
            $RN2=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrRN2[] = new RN2(
                    $row->vendedor
                    ,$row->ano
                    ,$row->mes
                    ,$row->modelo
                    ,$row->nmodelo
                    ,$row->bonus
                    ,$row->comissao_modelo
                );
            }
            return $arrRN2;                      
        }
    }
?>