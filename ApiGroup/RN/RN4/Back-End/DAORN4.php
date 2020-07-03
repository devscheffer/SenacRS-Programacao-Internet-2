<?php
    include_once __DIR__.'\objRN4.php';
    include_once __DIR__.'\..\..\..\..\PDOFactory.php';

    class RN4DAO
    {
        public function list()
        {
            $query = "
            select 
                idvendedor
                ,uf
                ,fechamentomes.ano
                ,fechamentomes.mes
            from (
                select 
                    idvendedor
                    ,uf
                from plvendedor
                left join plconcessionaria
                    on plvendedor.concessionaria = plconcessionaria.idconcessionaria
            ) as vendedorestado
            cross join fechamentomes
            left join (
                select 
                    vendedor
                    ,extract(year from data)::varchar(4) as ano
                    ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                    ,idsale
                from  venda
            ) as tabvenda
                on vendedorestado.idvendedor = tabvenda.vendedor
                and fechamentomes.ano = tabvenda.ano
                and fechamentomes.mes = tabvenda.mes
            where idsale is null
            ";
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
            $comando->execute();
            
            $RN4=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrRN4[] = new RN4(
                    $row->idvendedor
                    ,$row->uf
                    ,$row->ano
                    ,$row->mes
                );
            }
            return $arrRN4;
        }

        public function SearchByvendedor($idvendedor)
        {

             $query = "
             select 
                idvendedor
                ,uf
                ,fechamentomes.ano
                ,fechamentomes.mes
            from (
                select 
                    idvendedor
                    ,uf
                from plvendedor
                left join plconcessionaria
                    on plvendedor.concessionaria = plconcessionaria.idconcessionaria
            ) as vendedorestado
            cross join fechamentomes
            left join (
                select 
                    vendedor
                    ,extract(year from data)::varchar(4) as ano
                    ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                    ,idsale
                from  venda
            ) as tabvenda
                on vendedorestado.idvendedor = tabvenda.vendedor
                and fechamentomes.ano = tabvenda.ano
                and fechamentomes.mes = tabvenda.mes
            where idsale is null
                and idvendedor =:idvendedor
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':idvendedor', $idvendedor);
            
		    $comando->execute();
            
            $RN4=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrRN4[] = new RN4(
                    $row->idvendedor
                    ,$row->uf
                    ,$row->ano
                    ,$row->mes
                );
            }
            return $arrRN4;           
        }

        public function SearchByano($ano)
        {

             $query = "
             select 
                idvendedor
                ,uf
                ,fechamentomes.ano
                ,fechamentomes.mes
            from (
                select 
                    idvendedor
                    ,uf
                from plvendedor
                left join plconcessionaria
                    on plvendedor.concessionaria = plconcessionaria.idconcessionaria
            ) as vendedorestado
            cross join fechamentomes
            left join (
                select 
                    vendedor
                    ,extract(year from data)::varchar(4) as ano
                    ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                    ,idsale
                from  venda
            ) as tabvenda
                on vendedorestado.idvendedor = tabvenda.vendedor
                and fechamentomes.ano = tabvenda.ano
                and fechamentomes.mes = tabvenda.mes
            where idsale is null
                and fechamentomes.ano =:ano
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':ano', $ano);
            
		    $comando->execute();
            
            $RN4=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrRN4[] = new RN4(
                    $row->idvendedor
                    ,$row->uf
                    ,$row->ano
                    ,$row->mes
                );
            }
            return $arrRN4;             
        }

        public function SearchByanomes($ano,$mes)
        {

             $query = "
             select 
                idvendedor
                ,uf
                ,fechamentomes.ano
                ,fechamentomes.mes
            from (
                select 
                    idvendedor
                    ,uf
                from plvendedor
                left join plconcessionaria
                    on plvendedor.concessionaria = plconcessionaria.idconcessionaria
            ) as vendedorestado
            cross join fechamentomes
            left join (
                select 
                    vendedor
                    ,extract(year from data)::varchar(4) as ano
                    ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                    ,idsale
                from  venda
            ) as tabvenda
                on vendedorestado.idvendedor = tabvenda.vendedor
                and fechamentomes.ano = tabvenda.ano
                and fechamentomes.mes = tabvenda.mes
            where idsale is null
                and fechamentomes.ano =:ano
                and fechamentomes.mes =:mes
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam (':ano', $ano);
            $comando->bindParam (':mes', $mes);
            
		    $comando->execute();
            
            $RN4=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrRN4[] = new RN4(
                    $row->idvendedor
                    ,$row->uf
                    ,$row->ano
                    ,$row->mes
                );
            }
            return $arrRN4;           
        }
    }
?>