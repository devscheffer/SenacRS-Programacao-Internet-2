<?php
    include_once __DIR__.'\objRN1.php';
    include_once __DIR__.'\..\..\..\..\PDOFactory.php';

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
                ,(totalvenda * bonus) as comissao_mensal
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
                    ,$row->comissao_mensal
                );
            }
            return $arrRN1;
        }

        public function SearchByvendedor($vendedor)
        {

             $query = "
             select 
                vendedor
                ,ano
                ,mes
                ,totalvenda
                ,bonus
                ,(totalvenda * bonus) as comissao_mensal
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
            where vendedor =:vendedor
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':vendedor', $vendedor);
            
            $comando->execute();
            
            $RN1=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrRN1[] = new RN1(
                    $row->vendedor
                    ,$row->ano
                    ,$row->mes
                    ,$row->totalvenda
                    ,$row->bonus
                    ,$row->comissao_mensal
                );
            }
            return $arrRN1;           
        }

        public function SearchByano($ano)
        {

             $query = "
             select 
                vendedor
                ,ano
                ,mes
                ,totalvenda
                ,bonus
                ,(totalvenda * bonus) as comissao_mensal
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
            where ano =:ano
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':ano', $ano);
            
            $comando->execute();
            
            $RN1=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrRN1[] = new RN1(
                    $row->vendedor
                    ,$row->ano
                    ,$row->mes
                    ,$row->totalvenda
                    ,$row->bonus
                    ,$row->comissao_mensal
                );
            }
            return $arrRN1;             
        }

        public function SearchByanomes($ano,$mes)
        {

             $query = "
             select 
                vendedor
                ,ano
                ,mes
                ,totalvenda
                ,bonus
                ,(totalvenda * bonus) as comissao_mensal
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
            where ano =:ano
                and mes=:mes
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':ano', $ano);
            $comando->bindParam (':mes', $mes);
            
		    $comando->execute();
            
            $RN1=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrRN1[] = new RN1(
                    $row->vendedor
                    ,$row->ano
                    ,$row->mes
                    ,$row->totalvenda
                    ,$row->bonus
                    ,$row->comissao_mensal
                );
            }

            return $arrRN1;           
        }
    }
?>