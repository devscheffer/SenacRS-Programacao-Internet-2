<?php
    include_once __DIR__.'\..\OBJ\objRN4.php';
    include_once __DIR__.'\..\PDOFactory.php';

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
                    $row->IDVendedor
                    ,$row->UF
                    ,$row->Ano
                    ,$row->Mes
                );
            }
            return $arrRN4;
        }

        public function SearchByVendedor($IDVendedor)
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
                and vendedor =: vendedor
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('idvendedor', $IDVendedor);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new RN4(
                $result->IDVendedor
                ,$result->UF
                ,$result->Ano
                ,$result->Mes
            );           
        }

        public function SearchByAno($Ano)
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
                and ano =: ano
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('ano', $Ano);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new RN4(
                $result->IDVendedor
                ,$result->UF
                ,$result->Ano
                ,$result->Mes
            );             
        }

        public function SearchByAnoMes($Ano,$Mes)
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
                and ano =: ano
                and mes =: mes
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('ano', $Ano);
            $comando->bindParam ('mes', $Mes);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new RN4(
                $result->IDVendedor
                ,$result->UF
                ,$result->Ano
                ,$result->Mes
            );           
        }
    }
?>