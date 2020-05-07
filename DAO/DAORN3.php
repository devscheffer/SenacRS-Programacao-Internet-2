<?php
    include_once __DIR__.'\..\OBJ\objRN3.php';
    include_once __DIR__.'\..\PDOFactory.php';

    class RN3DAO
    {
        public function list()
        {
            $query = "
            select 
                concessionariavenda.concessionaria
                ,concessionariavenda.ano
                ,concessionariavenda.mes
                ,round(total_venda_concessionaria/nvendedor/efic_mes,2) as distlucro
            from (
                select 
                concessionaria
                ,extract(year from data)::varchar(4) as ano
                ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                ,sum(valor) as total_venda_concessionaria
            from venda
            group by 
                concessionaria
                ,ano
                ,mes
            ) as concessionariavenda

            left join (
                select 
                    concessionaria
                    ,count(*) as nvendedor
                from plvendedor
                group by concessionaria
            ) as concessionariaqtdfuncionario
                on concessionariavenda.concessionaria = concessionariaqtdfuncionario.concessionaria

            left join (
            select
                ano
                ,mes
                ,sum(concessionaria_efic) as efic_mes
            from (
                select 
                concessionariavenda.concessionaria
                ,concessionariavenda.ano
                ,concessionariavenda.mes
                ,total_venda_concessionaria/nvendedor as concessionaria_efic
                from (
                select 
                concessionaria
                ,extract(year from data)::varchar(4) as ano
                ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                ,sum(valor) as total_venda_concessionaria
                from venda
                group by 
                concessionaria
                ,ano
                ,mes
                ) as concessionariavenda

                left join (
                select 
                    concessionaria
                    ,count(*) as nvendedor
                from plvendedor
                group by concessionaria
                ) as concessionariaqtdfuncionario
                on concessionariavenda.concessionaria = concessionariaqtdfuncionario.concessionaria
            ) as tabefic
            group by 
                ano
                ,mes
            ) as efic_mes
            on concessionariavenda.ano = efic_mes.ano
            and concessionariavenda.mes = efic_mes.mes
            ";
            
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
            $comando->execute();
            
            $RN3=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){

			    $arrRN3[] = new RN3(
                    $row->Concessionaria
                    ,$row->Ano
                    ,$row->Mes
                    ,$row->DistLucro
                );
            }
            return $arrRN3;
        }

        public function SearchByVendedor($Vendedor)
        {

             $query = "
             select 
                concessionariavenda.concessionaria
                ,concessionariavenda.ano
                ,concessionariavenda.mes
                ,round(total_venda_concessionaria/nvendedor/efic_mes,2) as distlucro
            from (
                select 
                concessionaria
                ,extract(year from data)::varchar(4) as ano
                ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                ,sum(valor) as total_venda_concessionaria
            from venda
            group by 
                concessionaria
                ,ano
                ,mes
            ) as concessionariavenda

            left join (
                select 
                    concessionaria
                    ,count(*) as nvendedor
                from plvendedor
                group by concessionaria
            ) as concessionariaqtdfuncionario
                on concessionariavenda.concessionaria = concessionariaqtdfuncionario.concessionaria

            left join (
            select
                ano
                ,mes
                ,sum(concessionaria_efic) as efic_mes
            from (
                select 
                concessionariavenda.concessionaria
                ,concessionariavenda.ano
                ,concessionariavenda.mes
                ,total_venda_concessionaria/nvendedor as concessionaria_efic
                from (
                select 
                concessionaria
                ,extract(year from data)::varchar(4) as ano
                ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                ,sum(valor) as total_venda_concessionaria
                from venda
                group by 
                concessionaria
                ,ano
                ,mes
                ) as concessionariavenda

                left join (
                select 
                    concessionaria
                    ,count(*) as nvendedor
                from plvendedor
                group by concessionaria
                ) as concessionariaqtdfuncionario
                on concessionariavenda.concessionaria = concessionariaqtdfuncionario.concessionaria
            ) as tabefic
            group by 
                ano
                ,mes
            ) as efic_mes
            on concessionariavenda.ano = efic_mes.ano
            and concessionariavenda.mes = efic_mes.mes
            where vendedor =: vendedor
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('vendedor', $Vendedor);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new RN3(
                $result->Concessionaria
                ,$result->Ano
                ,$result->Mes
                ,$result->DistLucro
            );           
        }

        public function SearchByAno($Ano)
        {

             $query = "
             select 
                concessionariavenda.concessionaria
                ,concessionariavenda.ano
                ,concessionariavenda.mes
                ,round(total_venda_concessionaria/nvendedor/efic_mes,2) as distlucro
            from (
                select 
                concessionaria
                ,extract(year from data)::varchar(4) as ano
                ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                ,sum(valor) as total_venda_concessionaria
            from venda
            group by 
                concessionaria
                ,ano
                ,mes
            ) as concessionariavenda

            left join (
                select 
                    concessionaria
                    ,count(*) as nvendedor
                from plvendedor
                group by concessionaria
            ) as concessionariaqtdfuncionario
                on concessionariavenda.concessionaria = concessionariaqtdfuncionario.concessionaria

            left join (
            select
                ano
                ,mes
                ,sum(concessionaria_efic) as efic_mes
            from (
                select 
                concessionariavenda.concessionaria
                ,concessionariavenda.ano
                ,concessionariavenda.mes
                ,total_venda_concessionaria/nvendedor as concessionaria_efic
                from (
                select 
                concessionaria
                ,extract(year from data)::varchar(4) as ano
                ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                ,sum(valor) as total_venda_concessionaria
                from venda
                group by 
                concessionaria
                ,ano
                ,mes
                ) as concessionariavenda

                left join (
                select 
                    concessionaria
                    ,count(*) as nvendedor
                from plvendedor
                group by concessionaria
                ) as concessionariaqtdfuncionario
                on concessionariavenda.concessionaria = concessionariaqtdfuncionario.concessionaria
            ) as tabefic
            group by 
                ano
                ,mes
            ) as efic_mes
            on concessionariavenda.ano = efic_mes.ano
            and concessionariavenda.mes = efic_mes.mes
            where ano =: ano
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('ano', $Ano);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new RN3(
                $result->Concessionaria
                ,$result->Ano
                ,$result->Mes
                ,$result->DistLucro
            );             
        }

        public function SearchByAnoMes($Ano,$Mes)
        {

             $query = "
             select 
                concessionariavenda.concessionaria
                ,concessionariavenda.ano
                ,concessionariavenda.mes
                ,round(total_venda_concessionaria/nvendedor/efic_mes,2) as distlucro
            from (
                select 
                concessionaria
                ,extract(year from data)::varchar(4) as ano
                ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                ,sum(valor) as total_venda_concessionaria
            from venda
            group by 
                concessionaria
                ,ano
                ,mes
            ) as concessionariavenda

            left join (
                select 
                    concessionaria
                    ,count(*) as nvendedor
                from plvendedor
                group by concessionaria
            ) as concessionariaqtdfuncionario
                on concessionariavenda.concessionaria = concessionariaqtdfuncionario.concessionaria

            left join (
            select
                ano
                ,mes
                ,sum(concessionaria_efic) as efic_mes
            from (
                select 
                concessionariavenda.concessionaria
                ,concessionariavenda.ano
                ,concessionariavenda.mes
                ,total_venda_concessionaria/nvendedor as concessionaria_efic
                from (
                select 
                concessionaria
                ,extract(year from data)::varchar(4) as ano
                ,LPAD(extract(month from data)::varchar(2),2,'0') as mes
                ,sum(valor) as total_venda_concessionaria
                from venda
                group by 
                concessionaria
                ,ano
                ,mes
                ) as concessionariavenda

                left join (
                select 
                    concessionaria
                    ,count(*) as nvendedor
                from plvendedor
                group by concessionaria
                ) as concessionariaqtdfuncionario
                on concessionariavenda.concessionaria = concessionariaqtdfuncionario.concessionaria
            ) as tabefic
            group by 
                ano
                ,mes
            ) as efic_mes
            on concessionariavenda.ano = efic_mes.ano
            and concessionariavenda.mes = efic_mes.mes
            where 
                ano =: ano
                and mes =: mes
            ";
             
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            
            $comando->bindParam ('ano', $Ano);
            $comando->bindParam ('mes', $Mes);
            
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            
		    return new RN3(
                $result->Concessionaria
                ,$result->Ano
                ,$result->Mes
                ,$result->DistLucro
            );           
        }
    }
?>