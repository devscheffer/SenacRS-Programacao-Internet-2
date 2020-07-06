<?php
	include_once __DIR__.'\objcarro.php';
	include_once __DIR__.'\..\..\..\PDOFactory.php';

	class CarroDAO
	{
		public function insert(Carro $carro)
		{
			$qInsert = "INSERT INTO 
			plchassi(chassi, idmodelo, idversao, idcor)
			VALUES (
				:chassi
				,:idmodelo
				,:idversao
				,:idcor
			)";

			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($qInsert);

			$comando->bindParam(":chassi",$carro->chassi);
			$comando->bindParam(":idmodelo",$carro->obj_versao->obj_modelo->idmodelo);
			$comando->bindParam(":idversao",$carro->obj_versao->idversao);
			$comando->bindParam(":idcor",$carro->obj_cor->idcor);

			$comando->execute();
			
			return $carro;
		}

		public function delete($chassi)
		{
			$qDelete = "DELETE from 
			plchassi 
			WHERE chassi=:chassi";            
			$carro = $this->SearchByID($chassi);

			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($qDelete);

			$comando->bindParam(":chassi",$chassi);

			$comando->execute();
			return $carro;
		}

		public function update(carro $carro)
		{
			$qUpdate = "UPDATE 
			plchassi 
			SET 
				chassi=:chassi
				,idmodelo=:idmodelo
				,idversao=:idversao
				,idcor=:idcor
				WHERE chassi=:chassi";

			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($qUpdate);

			$comando->bindParam(":chassi",$carro->chassi);
			$comando->bindParam(":idmodelo",$carro->obj_versao->obj_modelo->idmodelo);
			$comando->bindParam(":idversao",$carro->obj_versao->idversao);
			$comando->bindParam(":idcor",$carro->obj_cor->idcor);

			$comando->execute();    
			return($carro);    
		}

		public function list()
		{
			$query = '
				SELECT 
					plchassi.chassi
					,plmodelo.idmodelo
					,plmodelo.descmodelo
					,plversao.idversao
					,plversao.descversao
					,plcor.idcor
					,plcor.desccor
				FROM plchassi
				join plmodelo
					on plmodelo.idmodelo = plchassi.idmodelo
				join plversao
					on plversao.idversao = plchassi.idversao
				join plcor
					on plcor.idcor = plchassi.idcor
			';
			
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$arr_carro=array();	
			while($row = $comando->fetch(PDO::FETCH_OBJ)){

				$arr_carro[] = new Carro(
					$row->chassi
					,new Versao(
						$row->idversao
						,$row->descversao
						,new Modelo(
							$row->idmodelo
							,$row->descmodelo
						)
					)
					,new Cor(
						$row->idcor
						,$row->desccor
					)
				);
			}
			return $arr_carro;
		}

		public function SearchByID($chassi)
		{

			$query = '
			SELECT 
					plchassi.chassi
					,plmodelo.idmodelo
					,plmodelo.descmodelo
					,plversao.idversao
					,plversao.descversao
					,plcor.idcor
					,plcor.desccor
				FROM plchassi
				join plmodelo
					on plmodelo.idmodelo = plchassi.idmodelo
				join plversao
					on plversao.idversao = plchassi.idversao
				join plcor
					on plcor.idcor = plchassi.idcor			 
			WHERE chassi=:chassi';

			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			
			$comando->bindParam (':chassi', $chassi);
			
			$comando->execute();
			$result = $comando->fetch(PDO::FETCH_OBJ);
			
			if($result)
				return new Carro(
					$result->chassi
					,new Versao(
						$result->idversao
						,$result->descversao
						,new Modelo(
							$result->idmodelo
							,$result->descmodelo
						)
					)
					,new Cor(
						$result->idcor
						,$result->desccor
					)
				);     
			else
                return null;      
		}
	}
?>