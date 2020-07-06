<?php
	include_once __DIR__.'\objVenda.php';
	include_once __DIR__.'\..\..\..\PDOFactory.php';

	class VendaDAO
	{
		public function insert(Venda $Venda)
		{
			$qInsert = "INSERT INTO 
			venda(idvenda, idconcessionaria, idvendedor, chassi, venda_data, valor)
			VALUES (
				:idvenda
				,:idconcessionaria
				,:idvendedor
				,:chassi
				,:venda_data
				,:valor
			)";

			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($qInsert);

			$comando->bindParam(":idvenda",$Venda->idvenda);
			$comando->bindParam(":venda_data",$Venda->venda_data);
			$comando->bindParam(":valor",$Venda->valor);
			$comando->bindParam(":idconcessionaria",$Venda->obj_concessionaria->idconcessionaria);
			$comando->bindParam(":idvendedor",$Venda->obj_vendedor->idvendedor);
			$comando->bindParam(":chassi",$Venda->obj_carro->chassi);

			$comando->execute();
			//$Venda->id = $pdo->lastInsertId();
			return $Venda;
		}

		public function delete($idvenda)
		{
			$qDelete = "DELETE from 
			venda 
			WHERE idvenda=:idvenda";            
			$Venda = $this->SearchByID($idvenda);

			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($qDelete);

			$comando->bindParam(":idvenda",$idvenda);

			$comando->execute();
			return $Venda;
		}

		public function update(Venda $Venda)
		{
			$qUpdate = "UPDATE 
			venda 
			SET 
				idvenda=:idvenda
				,idconcessionaria=:idconcessionaria
				,idvendedor=:idvendedor
				,chassi=:chassi
				,venda_data=:venda_data
				,valor=:valor
				WHERE idvenda=:idvenda";

			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($qUpdate);

			$comando->bindParam(":idvenda",$Venda->idvenda);
			$comando->bindParam(":idconcessionaria",$Venda->obj_concessionaria->idconcessionaria);
			$comando->bindParam(":idvendedor",$Venda->obj_vendedor->idvendedor);
			$comando->bindParam(":chassi",$Venda->obj_carro->chassi);
			$comando->bindParam(":venda_data",$Venda->venda_data);
			$comando->bindParam(":valor",$Venda->valor);

			$comando->execute();    
			return($Venda);    
		}

		public function list()
		{
			$query = '
			SELECT 
				idvenda
				, venda_data
				, valor
				, venda_concessionaria
				, nomefantasia
				, idvendedor
				, nome
				, chassi
			FROM vwvenda
			';
			
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$arr_venda=array();	
			while($row = $comando->fetch(PDO::FETCH_OBJ)){

				$arr_venda[] = new Venda(
					$row->idvenda
					,$row->venda_data
					,$row->valor
					,new Concessionaria(
						$row->venda_concessionaria
						,$row->nomefantasia
						,null
						,null
					)
					,new Vendedor(
						$row->idvendedor
						,$row->nome
						,null
						,new Concessionaria(
							null
							,null
							,null
							,null
						)
					)
					,new Carro(
						$row->chassi
						,new Versao(
							null
							,null
							,new Modelo(
								null
								,null
							)
						)
						,new Cor(
							null
							,null
						)
					)
				);
			}
			return $arr_venda;
		}

		public function SearchByID($idvenda){

			$query = '
			SELECT 
				idvenda
				, venda_data
				, valor
				, venda_concessionaria
				, nomefantasia
				, idvendedor
				, nome
				, chassi
			FROM vwvenda
			WHERE idvenda=:idvenda';

			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			
			$comando->bindParam (':idvenda', $idvenda);
			
			$comando->execute();
			$result = $comando->fetch(PDO::FETCH_OBJ);
			
			if($result)
				return new Venda(
					$result->idvenda
					,$result->venda_data
					,$result->valor
					,new Concessionaria(
						$result->venda_concessionaria
						,$result->nomefantasia
						,null
						,null
					)
					,new Vendedor(
						$result->idvendedor
						,$result->nome
						,null
						,new Concessionaria(
							null
							,null
							,null
							,null
						)
					)
					,new Carro(
						$result->chassi
						,new Versao(
							null
							,null
							,new Modelo(
								null
								,null
							)
						)
						,new Cor(
							null
							,null
						)
					)
				);       
				else
                return null;
		}
	}
?>