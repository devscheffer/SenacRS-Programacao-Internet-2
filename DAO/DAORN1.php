<?php
    include_once __DIR__.'\..\OBJ\objRN1.php';
    include_once __DIR__.'\..\PDOFactory.php';

    class RN1DAO
    {
        public function list()
        {
            $query = "
            select 
                vendedor
                ,ano
                ,mes
                ,totalvenda
                ,bonus
                ,(totalvenda * bonus) as Comissao_Mensal
            from (
                select 
                    vendedor
                    ,extract(year from data)::varchar(4) as year
                    ,LPAD(extract(month from data)::varchar(2),2,'0') as month
                    ,sum(valor) as totalvenda
                from venda
                group by 
                    vendedor
                    ,year
                    ,month
            ) as totalvenda
            left join prmbonusmes
                on totalvenda.year = prmbonusmes.ano
                and totalvenda.month = prmbonusmes.mes
            ";
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
            $comando->execute();
            
            $RN1=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrRN1[] = new RN1(
                    $row->vendedor
                    ,$row->ano
                    ,$row->mes
                    ,$row->totalvenda
                    ,$row->bonus
                    ,$row->Comissao_Mensal
                );
            }
            return $arrRN1;
        }

        public function SearchByVendedor($Vendedor)
        {

             $query = "
             select 
                vendedor
                ,ano
                ,mes
                ,totalvenda
                ,bonus
                ,(totalvenda * bonus) as Comissao_Mensal
            from (
                select 
                    vendedor
                    ,extract(year from data)::varchar(4) as year
                    ,LPAD(extract(month from data)::varchar(2),2,'0') as month
                    ,sum(valor) as totalvenda
                from venda
                group by 
                    vendedor
                    ,year
                    ,month
            ) as totalvenda
            left join prmbonusmes
                on totalvenda.year = prmbonusmes.ano
                and totalvenda.month = prmbonusmes.mes
            where vendedor =: vendedor
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('vendedor', $Vendedor);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new RN1(
                $result->vendedor
                ,$result->ano
                ,$result->mes
                ,$result->totalvenda
                ,$result->bonus
                ,$result->Comissao_Mensal
            );           
        }

        public function SearchByAno($Ano)
        {

             $query = "
             select 
                vendedor
                ,ano
                ,mes
                ,totalvenda
                ,bonus
                ,(totalvenda * bonus) as Comissao_Mensal
            from (
                select 
                    vendedor
                    ,extract(year from data)::varchar(4) as year
                    ,LPAD(extract(month from data)::varchar(2),2,'0') as month
                    ,sum(valor) as totalvenda
                from venda
                group by 
                    vendedor
                    ,year
                    ,month
            ) as totalvenda
            left join prmbonusmes
                on totalvenda.year = prmbonusmes.ano
                and totalvenda.month = prmbonusmes.mes
            where ano =: ano
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('ano', $Ano);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new RN1(
                $result->vendedor
                ,$result->ano
                ,$result->mes
                ,$result->totalvenda
                ,$result->bonus
                ,$result->Comissao_Mensal
            );             
        }

        public function SearchByAnoMes($Ano,$Mes)
        {

             $query = "
             select 
                vendedor
                ,ano
                ,mes
                ,totalvenda
                ,bonus
                ,(totalvenda * bonus) as Comissao_Mensal
            from (
                select 
                    vendedor
                    ,extract(year from data)::varchar(4) as year
                    ,LPAD(extract(month from data)::varchar(2),2,'0') as month
                    ,sum(valor) as totalvenda
                from venda
                group by 
                    vendedor
                    ,year
                    ,month
            ) as totalvenda
            left join prmbonusmes
                on totalvenda.year = prmbonusmes.ano
                and totalvenda.month = prmbonusmes.mes
            where ano =: ano
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('ano', $Ano);
            $comando->bindParam ('mes', $Mes);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new RN1(
                $result->vendedor
                ,$result->ano
                ,$result->mes
                ,$result->totalvenda
                ,$result->bonus
                ,$result->Comissao_Mensal
            );           
        }
    }
?>