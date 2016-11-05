<?php 
class ModelePrefixe{ 
	function creerPrefixe($prefixe, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO prefixe(idoperateur, prefixe, supprime) VALUES(:idoperateur, :prefixe, :supprime)"); 
			$reussite = $creer->execute(array(
				'idoperateur' => $prefixe->idoperateur,
				'prefixe' => $prefixe->prefixe,
				'supprime' => $prefixe->supprime)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerPrefixe : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourPrefixe($prefixe, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE prefixe SET idoperateur=:idoperateur,prefixe=:prefixe,supprime=:supprime WHERE idprefixe=:idprefixe "); 
			$reussite = $modifier->execute(array(
				'idoperateur' => $prefixe->idoperateur,
				'prefixe' => $prefixe->prefixe,
				'supprime' => $prefixe->supprime,
				'idprefixe' => $prefixe->idprefixe)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourPrefixe : ', $ex->getMessage() ; 
		}
	}


	function supprimerPrefixe($prefixe, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM prefixe WHERE idprefixe=:idprefixe "); 
			$reussite = $supprimer->execute(array(
				'idprefixe' => $prefixe->idprefixe)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerPrefixe : ', $ex->getMessage() ; 
		}
	}


	function trouverPrefixe($prefixe, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM prefixe WHERE idprefixe=:idprefixe") ; 
			$trouver->execute(array(
				'idprefixe' => $prefixe->idprefixe)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverPrefixe : ', $ex->getMessage() ; 
		}
	}


	function trouverTousPrefixe($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM prefixe") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverPrefixe : ', $ex->getMessage() ; 
		}
	}
} 
 