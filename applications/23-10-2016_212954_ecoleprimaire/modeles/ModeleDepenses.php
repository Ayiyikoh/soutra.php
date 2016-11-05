<?php 
class ModeleDepenses{ 
	function creerDepenses($depenses, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO depenses(idannee, dateDepense, montant, idTypeDepense, description, supprimer) VALUES(:idannee, :dateDepense, :montant, :idTypeDepense, :description, :supprimer)"); 
			$reussite = $creer->execute(array(
				'idannee' => $depenses->idannee,
				'dateDepense' => $depenses->dateDepense,
				'montant' => $depenses->montant,
				'idTypeDepense' => $depenses->idTypeDepense,
				'description' => $depenses->description,
				'supprimer' => $depenses->supprimer)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerDepenses : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourDepenses($depenses, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE depenses SET idannee=:idannee,dateDepense=:dateDepense,montant=:montant,idTypeDepense=:idTypeDepense,description=:description,supprimer=:supprimer WHERE iddepense=:iddepense "); 
			$reussite = $modifier->execute(array(
				'idannee' => $depenses->idannee,
				'dateDepense' => $depenses->dateDepense,
				'montant' => $depenses->montant,
				'idTypeDepense' => $depenses->idTypeDepense,
				'description' => $depenses->description,
				'supprimer' => $depenses->supprimer,
				'iddepense' => $depenses->iddepense)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourDepenses : ', $ex->getMessage() ; 
		}
	}


	function supprimerDepenses($depenses, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM depenses WHERE iddepense=:iddepense "); 
			$reussite = $supprimer->execute(array(
				'iddepense' => $depenses->iddepense)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerDepenses : ', $ex->getMessage() ; 
		}
	}


	function trouverDepenses($depenses, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM depenses WHERE iddepense=:iddepense") ; 
			$trouver->execute(array(
				'iddepense' => $depenses->iddepense)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverDepenses : ', $ex->getMessage() ; 
		}
	}


	function trouverTousDepenses($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM depenses") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverDepenses : ', $ex->getMessage() ; 
		}
	}
} 
 