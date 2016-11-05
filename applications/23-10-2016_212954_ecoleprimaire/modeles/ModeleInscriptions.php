<?php 
class ModeleInscriptions{ 
	function creerInscriptions($inscriptions, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO inscriptions(idannee, ideleve, dateInscription, idclasse, montant, idtypeEleve, raison, typeInscription, supprimer) VALUES(:idannee, :ideleve, :dateInscription, :idclasse, :montant, :idtypeEleve, :raison, :typeInscription, :supprimer)"); 
			$reussite = $creer->execute(array(
				'idannee' => $inscriptions->idannee,
				'ideleve' => $inscriptions->ideleve,
				'dateInscription' => $inscriptions->dateInscription,
				'idclasse' => $inscriptions->idclasse,
				'montant' => $inscriptions->montant,
				'idtypeEleve' => $inscriptions->idtypeEleve,
				'raison' => $inscriptions->raison,
				'typeInscription' => $inscriptions->typeInscription,
				'supprimer' => $inscriptions->supprimer)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerInscriptions : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourInscriptions($inscriptions, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE inscriptions SET idannee=:idannee,ideleve=:ideleve,dateInscription=:dateInscription,idclasse=:idclasse,montant=:montant,idtypeEleve=:idtypeEleve,raison=:raison,typeInscription=:typeInscription,supprimer=:supprimer WHERE idinscription=:idinscription "); 
			$reussite = $modifier->execute(array(
				'idannee' => $inscriptions->idannee,
				'ideleve' => $inscriptions->ideleve,
				'dateInscription' => $inscriptions->dateInscription,
				'idclasse' => $inscriptions->idclasse,
				'montant' => $inscriptions->montant,
				'idtypeEleve' => $inscriptions->idtypeEleve,
				'raison' => $inscriptions->raison,
				'typeInscription' => $inscriptions->typeInscription,
				'supprimer' => $inscriptions->supprimer,
				'idinscription' => $inscriptions->idinscription)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourInscriptions : ', $ex->getMessage() ; 
		}
	}


	function supprimerInscriptions($inscriptions, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM inscriptions WHERE idinscription=:idinscription "); 
			$reussite = $supprimer->execute(array(
				'idinscription' => $inscriptions->idinscription)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerInscriptions : ', $ex->getMessage() ; 
		}
	}


	function trouverInscriptions($inscriptions, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM inscriptions WHERE idinscription=:idinscription") ; 
			$trouver->execute(array(
				'idinscription' => $inscriptions->idinscription)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverInscriptions : ', $ex->getMessage() ; 
		}
	}


	function trouverTousInscriptions($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM inscriptions") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverInscriptions : ', $ex->getMessage() ; 
		}
	}
} 
 