<?php 
class ModeleTypeoperateur{ 
	function creerTypeoperateur($typeoperateur, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO typeoperateur(typeoperateur, supprime) VALUES(:typeoperateur, :supprime)"); 
			$reussite = $creer->execute(array(
				'typeoperateur' => $typeoperateur->typeoperateur,
				'supprime' => $typeoperateur->supprime)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerTypeoperateur : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourTypeoperateur($typeoperateur, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE typeoperateur SET typeoperateur=:typeoperateur,supprime=:supprime WHERE idtypeoperateur=:idtypeoperateur "); 
			$reussite = $modifier->execute(array(
				'typeoperateur' => $typeoperateur->typeoperateur,
				'supprime' => $typeoperateur->supprime,
				'idtypeoperateur' => $typeoperateur->idtypeoperateur)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourTypeoperateur : ', $ex->getMessage() ; 
		}
	}


	function supprimerTypeoperateur($typeoperateur, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM typeoperateur WHERE idtypeoperateur=:idtypeoperateur "); 
			$reussite = $supprimer->execute(array(
				'idtypeoperateur' => $typeoperateur->idtypeoperateur)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerTypeoperateur : ', $ex->getMessage() ; 
		}
	}


	function trouverTypeoperateur($typeoperateur, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM typeoperateur WHERE idtypeoperateur=:idtypeoperateur") ; 
			$trouver->execute(array(
				'idtypeoperateur' => $typeoperateur->idtypeoperateur)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTypeoperateur : ', $ex->getMessage() ; 
		}
	}


	function trouverTousTypeoperateur($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM typeoperateur") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTypeoperateur : ', $ex->getMessage() ; 
		}
	}
} 
 