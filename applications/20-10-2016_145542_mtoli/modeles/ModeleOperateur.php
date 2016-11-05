<?php 
class ModeleOperateur{ 
	function creerOperateur($operateur, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO operateur(idtyoperateur, operateur, supprime) VALUES(:idtyoperateur, :operateur, :supprime)"); 
			$reussite = $creer->execute(array(
				'idtyoperateur' => $operateur->idtyoperateur,
				'operateur' => $operateur->operateur,
				'supprime' => $operateur->supprime)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerOperateur : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourOperateur($operateur, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE operateur SET idtyoperateur=:idtyoperateur,operateur=:operateur,supprime=:supprime WHERE idoperateur=:idoperateur "); 
			$reussite = $modifier->execute(array(
				'idtyoperateur' => $operateur->idtyoperateur,
				'operateur' => $operateur->operateur,
				'supprime' => $operateur->supprime,
				'idoperateur' => $operateur->idoperateur)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourOperateur : ', $ex->getMessage() ; 
		}
	}


	function supprimerOperateur($operateur, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM operateur WHERE idoperateur=:idoperateur "); 
			$reussite = $supprimer->execute(array(
				'idoperateur' => $operateur->idoperateur)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerOperateur : ', $ex->getMessage() ; 
		}
	}


	function trouverOperateur($operateur, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM operateur WHERE idoperateur=:idoperateur") ; 
			$trouver->execute(array(
				'idoperateur' => $operateur->idoperateur)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverOperateur : ', $ex->getMessage() ; 
		}
	}


	function trouverTousOperateur($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM operateur") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverOperateur : ', $ex->getMessage() ; 
		}
	}
} 
 