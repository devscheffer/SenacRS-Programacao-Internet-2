<?php
    include_once __DIR__.'\objRN1.php';
    include_once __DIR__.'\..\..\..\..\PDOFactory.php';

    class RN1DAO
    {
        public function list()
        {
            $query = "
            select 
                idvendedor
                ,ano
                ,mes
                ,totalvenda
                ,bonus
                ,(totalvenda * bonus) as comissao_mensal
            from (
                select 
                    idvendedor
                    ,extract(year from venda_data)::varchar(4) as year
                    ,LPAD(extract(month from venda_data)::varchar(2),2,'0') as month
                    ,sum(valor) as totalvenda
                from venda
                group by 
                    idvendedor
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
            
            $arr_rn1=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arr_rn1[] = new RN1(
                    new Vendedor(
                        $row->idvendedor
                        ,null
                        ,null
                        ,new Concessionaria(
                            null
                            ,null
                            ,null
                            ,null
                        )
                    )
                    ,$row->ano
                    ,$row->mes
                    ,$row->totalvenda
                    ,$row->bonus
                    ,$row->comissao_mensal
                );
            }
            return $arr_rn1;
        }

        public function SearchByvendedor($idvendedor)
        {

            $query = "
            select 
                idvendedor
                ,ano
                ,mes
                ,totalvenda
                ,bonus
                ,(totalvenda * bonus) as comissao_mensal
            from (
                select 
                    idvendedor
                    ,extract(year from venda_data)::varchar(4) as year
                    ,LPAD(extract(month from venda_data)::varchar(2),2,'0') as month
                    ,sum(valor) as totalvenda
                from venda
                group by 
                    idvendedor
                    ,year
                    ,month
            ) as totalvenda
            left join prmbonusmes
                on totalvenda.year = prmbonusmes.ano
                and totalvenda.month = prmbonusmes.mes
            where idvendedor =:idvendedor
            ";

            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':idvendedor', $idvendedor);
            
            $comando->execute();
            
            $arr_RN1=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arr_RN1[] = new RN1(
                    new Vendedor(
                        $row->idvendedor
                        ,null
                        ,null
                        ,new Concessionaria(
                            null
                            ,null
                            ,null
                            ,null
                        )
                    )
                    ,$row->ano
                    ,$row->mes
                    ,$row->totalvenda
                    ,$row->bonus
                    ,$row->comissao_mensal
                );
            }
            return $arr_RN1;           
        }

        public function SearchByano($ano)
        {

             $query = "
             select 
                idvendedor
                ,ano
                ,mes
                ,totalvenda
                ,bonus
                ,(totalvenda * bonus) as comissao_mensal
            from (
                select 
                    idvendedor
                    ,extract(year from venda_data)::varchar(4) as year
                    ,LPAD(extract(month from venda_data)::varchar(2),2,'0') as month
                    ,sum(valor) as totalvenda
                from venda
                group by 
                    idvendedor
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
            
            $arr_RN1=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arr_RN1[] = new RN1(
                    new Vendedor(
                        $row->idvendedor
                        ,null
                        ,null
                        ,new Concessionaria(
                            null
                            ,null
                            ,null
                            ,null
                        )
                    )
                    ,$row->ano
                    ,$row->mes
                    ,$row->totalvenda
                    ,$row->bonus
                    ,$row->comissao_mensal
                );
            }
            return $arr_RN1;             
        }

        public function SearchByanomes($ano,$mes)
        {

             $query = "
             select 
                idvendedor
                ,ano
                ,mes
                ,totalvenda
                ,bonus
                ,(totalvenda * bonus) as comissao_mensal
            from (
                select 
                    idvendedor
                    ,extract(year from venda_data)::varchar(4) as year
                    ,LPAD(extract(month from venda_data)::varchar(2),2,'0') as month
                    ,sum(valor) as totalvenda
                from venda
                group by 
                    idvendedor
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
            
            $arr_RN1=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arr_RN1[] = new RN1(
                    new Vendedor(
                        $row->idvendedor
                        ,null
                        ,null
                        ,new Concessionaria(
                            null
                            ,null
                            ,null
                            ,null
                        )
                    )
                    ,$row->ano
                    ,$row->mes
                    ,$row->totalvenda
                    ,$row->bonus
                    ,$row->comissao_mensal
                );
            }

            return $arr_RN1;           
        }
    }
?>