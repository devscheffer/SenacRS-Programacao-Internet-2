<?php
	include_once __DIR__.'\objvendedor.php';
	include_once __DIR__.'\..\..\..\PDOFactory.php';

	class VendedorDAO
	{
		public function insert(vendedor $vendedor)
		{
			$qInsert = "INSERT INTO 
			plvendedor(idvendedor, nome, email, idconcessionaria)
			VALUES (
				:idvendedor
				,:nome
				,:email
				,:idconcessionaria
			)";

			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($qInsert);

			$comando->bindParam(":idvendedor",$vendedor->idvendedor);
			$comando->bindParam(":nome",$vendedor->nome);
			$comando->bindParam(":email",$vendedor->email);
			$comando->bindParam(":idconcessionaria",$vendedor->obj_concessionaria->idconcessionaria);

			$comando->execute();
			//$vendedor->id = $pdo->lastInsertId();
			return $vendedor;
		}

		public function delete($idvendedor)
		{
			$qDelete = "DELETE from 
			plvendedor 
			WHERE idvendedor=:idvendedor";            
			$vendedor = $this->SearchByID($idvendedor);

			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($qDelete);

			$comando->bindParam(":idvendedor",$idvendedor);

			$comando->execute();
			return $vendedor;
		}

		public function update(vendedor $vendedor)
		{
			$qUpdate = "UPDATE 
			plvendedor 
			SET 
				idvendedor=:idvendedor
				,nome=:nome
				,email=:email
				,idconcessionaria=:idconcessionaria
				WHERE idvendedor=:idvendedor";

			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($qUpdate);

			$comando->bindParam(":idvendedor",$vendedor->idvendedor);
			$comando->bindParam(":nome",$vendedor->nome);
			$comando->bindParam(":email",$vendedor->email);
			$comando->bindParam(":idconcessionaria",$vendedor->obj_concessionaria->idconcessionaria);

			$comando->execute();    
			return($vendedor);    
		}

		public function list()
		{
			$query = '
				SELECT 
					plvendedor.idvendedor
					,plvendedor.nome
					,plvendedor.email
					,plconcessionaria.idconcessionaria
					,plconcessionaria.nomefantasia
					,plconcessionaria.uf
					,plconcessionaria.municipio
				FROM plvendedor
				join plconcessionaria
					on plvendedor.idconcessionaria = plconcessionaria.idconcessionaria
			';
			
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();

			$arr_vendedor=array();	
			while($row = $comando->fetch(PDO::FETCH_OBJ)){

				$arr_vendedor[] = new Vendedor(
					$row->idvendedor
					,$row->nome
					,$row->email
					,new concessionaria(
						$row->idconcessionaria
						,$row->nomefantasia
						,$row->uf
						,$row->municipio
					)
				);
			}
			return $arr_vendedor;
		}

		public function SearchByID($idvendedor)
		{

			$query = '
				SELECT 
					plvendedor.idvendedor
					,plvendedor.nome
					,plvendedor.email
					,plconcessionaria.idconcessionaria
					,plconcessionaria.nomefantasia
					,plconcessionaria.uf
					,plconcessionaria.municipio
				FROM plvendedor
				join plconcessionaria
					on plvendedor.idconcessionaria = plconcessionaria.idconcessionaria 
				WHERE idvendedor=:idvendedor';

			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			
			$comando->bindParam (':idvendedor', $idvendedor);
			
			$comando->execute();
			$result = $comando->fetch(PDO::FETCH_OBJ);
			
			if($result)
				return new Vendedor(
					$result->idvendedor
					,$result->nome
					,$result->email
					,new concessionaria(
						$result->idconcessionaria
						,$result->nomefantasia
						,$result->uf
						,$result->municipio
					)
				);           
			else
                return null;
		}
	}
?>