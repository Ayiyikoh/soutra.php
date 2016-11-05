<?php 
class ModeleVersements{ 
	function creerVersements($versements, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO versements(versement, supprimer) VALUES(:versement, :supprimer)"); 
			$reussite = $creer->execute(array(
				'versement' => $versements->versement,
				'supprimer' => $versements->supprimer)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerVersements : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourVersements($versements, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE versements SET versement=:versement,supprimer=:supprimer WHERE idversement=:idversement "); 
			$reussite = $modifier->execute(array(
				'versement' => $versements->versement,
				'supprimer' => $versements->supprimer,
				'idversement' => $versements->idversement)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourVersements : ', $ex->getMessage() ; 
		}
	}


	function supprimerVersements($versements, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM versements WHERE idversement=:idversement "); 
			$reussite = $supprimer->execute(array(
				'idversement' => $versements->idversement)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerVersements : ', $ex->getMessage() ; 
		}
	}


	function trouverVersements($versements, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM versements WHERE idversement=:idversement") ; 
			$trouver->execute(array(
				'idversement' => $versements->idversement)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverVersements : ', $ex->getMessage() ; 
		}
	}


	function trouverTousVersements($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM versements") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverVersements : ', $ex->getMessage() ; 
		}
	}
} 
 