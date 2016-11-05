<?php 
class ModeleScolarites{ 
	function creerScolarites($scolarites, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO scolarites(idannee, idclasse, scolarite, montant, versement1, versement2, versement3, versement4, supprimer) VALUES(:idannee, :idclasse, :scolarite, :montant, :versement1, :versement2, :versement3, :versement4, :supprimer)"); 
			$reussite = $creer->execute(array(
				'idannee' => $scolarites->idannee,
				'idclasse' => $scolarites->idclasse,
				'scolarite' => $scolarites->scolarite,
				'montant' => $scolarites->montant,
				'versement1' => $scolarites->versement1,
				'versement2' => $scolarites->versement2,
				'versement3' => $scolarites->versement3,
				'versement4' => $scolarites->versement4,
				'supprimer' => $scolarites->supprimer)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerScolarites : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourScolarites($scolarites, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE scolarites SET idannee=:idannee,idclasse=:idclasse,scolarite=:scolarite,montant=:montant,versement1=:versement1,versement2=:versement2,versement3=:versement3,versement4=:versement4,supprimer=:supprimer WHERE idscolarite=:idscolarite "); 
			$reussite = $modifier->execute(array(
				'idannee' => $scolarites->idannee,
				'idclasse' => $scolarites->idclasse,
				'scolarite' => $scolarites->scolarite,
				'montant' => $scolarites->montant,
				'versement1' => $scolarites->versement1,
				'versement2' => $scolarites->versement2,
				'versement3' => $scolarites->versement3,
				'versement4' => $scolarites->versement4,
				'supprimer' => $scolarites->supprimer,
				'idscolarite' => $scolarites->idscolarite)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourScolarites : ', $ex->getMessage() ; 
		}
	}


	function supprimerScolarites($scolarites, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM scolarites WHERE idscolarite=:idscolarite "); 
			$reussite = $supprimer->execute(array(
				'idscolarite' => $scolarites->idscolarite)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerScolarites : ', $ex->getMessage() ; 
		}
	}


	function trouverScolarites($scolarites, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM scolarites WHERE idscolarite=:idscolarite") ; 
			$trouver->execute(array(
				'idscolarite' => $scolarites->idscolarite)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverScolarites : ', $ex->getMessage() ; 
		}
	}


	function trouverTousScolarites($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM scolarites") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverScolarites : ', $ex->getMessage() ; 
		}
	}
} 
 