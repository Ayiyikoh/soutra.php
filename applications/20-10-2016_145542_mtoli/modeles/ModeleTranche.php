<?php 
class ModeleTranche{ 
	function creerTranche($tranche, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO tranche(tranche, supprime) VALUES(:tranche, :supprime)"); 
			$reussite = $creer->execute(array(
				'tranche' => $tranche->tranche,
				'supprime' => $tranche->supprime)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerTranche : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourTranche($tranche, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE tranche SET tranche=:tranche,supprime=:supprime WHERE idtranche=:idtranche "); 
			$reussite = $modifier->execute(array(
				'tranche' => $tranche->tranche,
				'supprime' => $tranche->supprime,
				'idtranche' => $tranche->idtranche)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourTranche : ', $ex->getMessage() ; 
		}
	}


	function supprimerTranche($tranche, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM tranche WHERE idtranche=:idtranche "); 
			$reussite = $supprimer->execute(array(
				'idtranche' => $tranche->idtranche)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerTranche : ', $ex->getMessage() ; 
		}
	}


	function trouverTranche($tranche, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM tranche WHERE idtranche=:idtranche") ; 
			$trouver->execute(array(
				'idtranche' => $tranche->idtranche)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTranche : ', $ex->getMessage() ; 
		}
	}


	function trouverTousTranche($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM tranche") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTranche : ', $ex->getMessage() ; 
		}
	}
} 
 