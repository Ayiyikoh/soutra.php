<?php 
class ModeleMouvementagent{ 
	function creerMouvementagent($mouvementagent, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO mouvementagent(idtransfert, typemouvement, datemouvement, montant, supprime) VALUES(:idtransfert, :typemouvement, :datemouvement, :montant, :supprime)"); 
			$reussite = $creer->execute(array(
				'idtransfert' => $mouvementagent->idtransfert,
				'typemouvement' => $mouvementagent->typemouvement,
				'datemouvement' => $mouvementagent->datemouvement,
				'montant' => $mouvementagent->montant,
				'supprime' => $mouvementagent->supprime)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerMouvementagent : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourMouvementagent($mouvementagent, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE mouvementagent SET idtransfert=:idtransfert,typemouvement=:typemouvement,datemouvement=:datemouvement,montant=:montant,supprime=:supprime WHERE idmovement=:idmovement "); 
			$reussite = $modifier->execute(array(
				'idtransfert' => $mouvementagent->idtransfert,
				'typemouvement' => $mouvementagent->typemouvement,
				'datemouvement' => $mouvementagent->datemouvement,
				'montant' => $mouvementagent->montant,
				'supprime' => $mouvementagent->supprime,
				'idmovement' => $mouvementagent->idmovement)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourMouvementagent : ', $ex->getMessage() ; 
		}
	}


	function supprimerMouvementagent($mouvementagent, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM mouvementagent WHERE idmovement=:idmovement "); 
			$reussite = $supprimer->execute(array(
				'idmovement' => $mouvementagent->idmovement)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerMouvementagent : ', $ex->getMessage() ; 
		}
	}


	function trouverMouvementagent($mouvementagent, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM mouvementagent WHERE idmovement=:idmovement") ; 
			$trouver->execute(array(
				'idmovement' => $mouvementagent->idmovement)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverMouvementagent : ', $ex->getMessage() ; 
		}
	}


	function trouverTousMouvementagent($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM mouvementagent") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverMouvementagent : ', $ex->getMessage() ; 
		}
	}
} 
 