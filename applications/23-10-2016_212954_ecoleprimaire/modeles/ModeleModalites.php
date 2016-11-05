<?php 
class ModeleModalites{ 
	function creerModalites($modalites, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO modalites(idversement, ideleve, montant, dateVersement, supprimer) VALUES(:idversement, :ideleve, :montant, :dateVersement, :supprimer)"); 
			$reussite = $creer->execute(array(
				'idversement' => $modalites->idversement,
				'ideleve' => $modalites->ideleve,
				'montant' => $modalites->montant,
				'dateVersement' => $modalites->dateVersement,
				'supprimer' => $modalites->supprimer)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerModalites : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourModalites($modalites, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE modalites SET idversement=:idversement,ideleve=:ideleve,montant=:montant,dateVersement=:dateVersement,supprimer=:supprimer WHERE idmodalite=:idmodalite "); 
			$reussite = $modifier->execute(array(
				'idversement' => $modalites->idversement,
				'ideleve' => $modalites->ideleve,
				'montant' => $modalites->montant,
				'dateVersement' => $modalites->dateVersement,
				'supprimer' => $modalites->supprimer,
				'idmodalite' => $modalites->idmodalite)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourModalites : ', $ex->getMessage() ; 
		}
	}


	function supprimerModalites($modalites, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM modalites WHERE idmodalite=:idmodalite "); 
			$reussite = $supprimer->execute(array(
				'idmodalite' => $modalites->idmodalite)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerModalites : ', $ex->getMessage() ; 
		}
	}


	function trouverModalites($modalites, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM modalites WHERE idmodalite=:idmodalite") ; 
			$trouver->execute(array(
				'idmodalite' => $modalites->idmodalite)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverModalites : ', $ex->getMessage() ; 
		}
	}


	function trouverTousModalites($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM modalites") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverModalites : ', $ex->getMessage() ; 
		}
	}
} 
 