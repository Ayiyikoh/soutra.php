<?php 
class ModeleEtudiant{ 
	function creerEtudiant($etudiant, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO etudiant(matricule, nom, prenom, dateNaiss, lieurNaiss) VALUES(:matricule, :nom, :prenom, :dateNaiss, :lieurNaiss)"); 
			$reussite = $creer->execute(array(
				'matricule' => $etudiant->matricule,
				'nom' => $etudiant->nom,
				'prenom' => $etudiant->prenom,
				'dateNaiss' => $etudiant->dateNaiss,
				'lieurNaiss' => $etudiant->lieurNaiss)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerEtudiant : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourEtudiant($etudiant, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE etudiant SET matricule=:matricule,nom=:nom,prenom=:prenom,dateNaiss=:dateNaiss,lieurNaiss=:lieurNaiss WHERE id=:id "); 
			$reussite = $modifier->execute(array(
				'matricule' => $etudiant->matricule,
				'nom' => $etudiant->nom,
				'prenom' => $etudiant->prenom,
				'dateNaiss' => $etudiant->dateNaiss,
				'lieurNaiss' => $etudiant->lieurNaiss,
				'id' => $etudiant->id)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourEtudiant : ', $ex->getMessage() ; 
		}
	}


	function supprimerEtudiant($etudiant, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM etudiant WHERE id=:id "); 
			$reussite = $supprimer->execute(array(
				'id' => $etudiant->id)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerEtudiant : ', $ex->getMessage() ; 
		}
	}


	function trouverEtudiant($etudiant, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM etudiant WHERE id=:id") ; 
			$trouver->execute(array(
				'id' => $etudiant->id)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverEtudiant : ', $ex->getMessage() ; 
		}
	}


	function trouverTousEtudiant($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM etudiant") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverEtudiant : ', $ex->getMessage() ; 
		}
	}
} 
 