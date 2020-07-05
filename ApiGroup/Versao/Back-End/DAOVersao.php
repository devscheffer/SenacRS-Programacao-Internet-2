<?php
	include_once __DIR__.'\objversao.php';
	include_once __DIR__.'\..\..\..\PDOFactory.php';

	class VersaoDAO
	{
		public function insert(Versao $versao)
		{
			$qInsert = "INSERT INTO 
			plversao(idversao, idmodelo, descversao)
			VALUES (
				:idversao
				,:idmodelo
				,:descversao
			)";

			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($qInsert);

			$comando->bindParam(":idversao",$versao->idversao);
			$comando->bindParam(":idmodelo",$versao->obj_modelo->idmodelo);
			$comando->bindParam(":descversao",$versao->descversao);


			$comando->execute();
			//$versao->id = $pdo->lastInsertId();
			return $versao;
		}

		public function delete($idversao)
		{
			$qDelete = "DELETE from 
			plversao 
			WHERE idversao=:idversao";            
			$versao = $this->SearchByID($idversao);

			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($qDelete);

			$comando->bindParam(":idversao",$idversao);

			$comando->execute();
			return $versao;
		}

		public function update(Versao $versao)
		{
			$qUpdate = "UPDATE 
			plversao 
			SET 
				idversao=:idversao
				,idmodelo=:idmodelo
				,descversao=:descversao
				WHERE idversao=:idversao";

			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($qUpdate);

			$comando->bindParam(":idversao",$versao->idversao);
			$comando->bindParam(":idmodelo",$versao->obj_modelo->idmodelo);
			$comando->bindParam(":descversao",$versao->descversao);


			$comando->execute();    
			return($versao);    
		}

		public function list()
		{
			$query = '
				SELECT 
					plversao.idversao
					,plversao.descversao
					,plmodelo.idmodelo
					,plmodelo.descmodelo
				FROM plversao
				join plmodelo
					on plversao.idmodelo = plmodelo.idmodelo
			';
			
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();

			$arr_versao=array();	
			while($row = $comando->fetch(PDO::FETCH_OBJ)){
				$arr_versao[] = new Versao(
					$row->idversao
					,$row->descversao
					,new Modelo(
						$row->idmodelo
						,$row->descmodelo
					)
				);
			}
			return $arr_versao;
		}

		public function SearchByID($idversao)
		{

			$query = '
				SELECT 
					plmodelo.idmodelo as idmodelo
					,plmodelo.descmodelo as descmodelo
					,plversao.idversao as idversao
					,plversao.descversao as descversao
				FROM plversao
				join plmodelo
					on plversao.idmodelo = plmodelo.idmodelo
				WHERE idversao=:idversao';

			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			
			$comando->bindParam (':idversao', $idversao);
			
			$comando->execute();
			$result = $comando->fetch(PDO::FETCH_OBJ);
			if($result)
				return new Versao(
					$result->idversao
					,$result->descversao
					,new Modelo(
						$result->idmodelo
						,$result->descmodelo
					)
				);           
			else
                return null;
		}
	}
?>