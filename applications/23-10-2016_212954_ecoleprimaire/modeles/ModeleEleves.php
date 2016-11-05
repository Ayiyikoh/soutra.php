<?php 
class ModeleEleves{ 
	function creerEleves($eleves, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO eleves(idannee, matricule, datePremiereInscription, nom, prenom, sexe, numeroacteDeNaissance, dateDeNaissance, lieuDeNaissance, ecoleDOrigine, nomPere, professionPere, DomicilePere, contactPere, nomMere, professionMere, DomicileMere, contactMere, nomTuteur, professionTuteur, domicileTuteur, contactTuteur, supprimer) VALUES(:idannee, :matricule, :datePremiereInscription, :nom, :prenom, :sexe, :numeroacteDeNaissance, :dateDeNaissance, :lieuDeNaissance, :ecoleDOrigine, :nomPere, :professionPere, :DomicilePere, :contactPere, :nomMere, :professionMere, :DomicileMere, :contactMere, :nomTuteur, :professionTuteur, :domicileTuteur, :contactTuteur, :supprimer)"); 
			$reussite = $creer->execute(array(
				'idannee' => $eleves->idannee,
				'matricule' => $eleves->matricule,
				'datePremiereInscription' => $eleves->datePremiereInscription,
				'nom' => $eleves->nom,
				'prenom' => $eleves->prenom,
				'sexe' => $eleves->sexe,
				'numeroacteDeNaissance' => $eleves->numeroacteDeNaissance,
				'dateDeNaissance' => $eleves->dateDeNaissance,
				'lieuDeNaissance' => $eleves->lieuDeNaissance,
				'ecoleDOrigine' => $eleves->ecoleDOrigine,
				'nomPere' => $eleves->nomPere,
				'professionPere' => $eleves->professionPere,
				'DomicilePere' => $eleves->DomicilePere,
				'contactPere' => $eleves->contactPere,
				'nomMere' => $eleves->nomMere,
				'professionMere' => $eleves->professionMere,
				'DomicileMere' => $eleves->DomicileMere,
				'contactMere' => $eleves->contactMere,
				'nomTuteur' => $eleves->nomTuteur,
				'professionTuteur' => $eleves->professionTuteur,
				'domicileTuteur' => $eleves->domicileTuteur,
				'contactTuteur' => $eleves->contactTuteur,
				'supprimer' => $eleves->supprimer)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerEleves : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourEleves($eleves, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE eleves SET idannee=:idannee,matricule=:matricule,datePremiereInscription=:datePremiereInscription,nom=:nom,prenom=:prenom,sexe=:sexe,numeroacteDeNaissance=:numeroacteDeNaissance,dateDeNaissance=:dateDeNaissance,lieuDeNaissance=:lieuDeNaissance,ecoleDOrigine=:ecoleDOrigine,nomPere=:nomPere,professionPere=:professionPere,DomicilePere=:DomicilePere,contactPere=:contactPere,nomMere=:nomMere,professionMere=:professionMere,DomicileMere=:DomicileMere,contactMere=:contactMere,nomTuteur=:nomTuteur,professionTuteur=:professionTuteur,domicileTuteur=:domicileTuteur,contactTuteur=:contactTuteur,supprimer=:supprimer WHERE ideleve=:ideleve "); 
			$reussite = $modifier->execute(array(
				'idannee' => $eleves->idannee,
				'matricule' => $eleves->matricule,
				'datePremiereInscription' => $eleves->datePremiereInscription,
				'nom' => $eleves->nom,
				'prenom' => $eleves->prenom,
				'sexe' => $eleves->sexe,
				'numeroacteDeNaissance' => $eleves->numeroacteDeNaissance,
				'dateDeNaissance' => $eleves->dateDeNaissance,
				'lieuDeNaissance' => $eleves->lieuDeNaissance,
				'ecoleDOrigine' => $eleves->ecoleDOrigine,
				'nomPere' => $eleves->nomPere,
				'professionPere' => $eleves->professionPere,
				'DomicilePere' => $eleves->DomicilePere,
				'contactPere' => $eleves->contactPere,
				'nomMere' => $eleves->nomMere,
				'professionMere' => $eleves->professionMere,
				'DomicileMere' => $eleves->DomicileMere,
				'contactMere' => $eleves->contactMere,
				'nomTuteur' => $eleves->nomTuteur,
				'professionTuteur' => $eleves->professionTuteur,
				'domicileTuteur' => $eleves->domicileTuteur,
				'contactTuteur' => $eleves->contactTuteur,
				'supprimer' => $eleves->supprimer,
				'ideleve' => $eleves->ideleve)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourEleves : ', $ex->getMessage() ; 
		}
	}


	function supprimerEleves($eleves, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM eleves WHERE ideleve=:ideleve "); 
			$reussite = $supprimer->execute(array(
				'ideleve' => $eleves->ideleve)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerEleves : ', $ex->getMessage() ; 
		}
	}


	function trouverEleves($eleves, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM eleves WHERE ideleve=:ideleve") ; 
			$trouver->execute(array(
				'ideleve' => $eleves->ideleve)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverEleves : ', $ex->getMessage() ; 
		}
	}


	function trouverTousEleves($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM eleves") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverEleves : ', $ex->getMessage() ; 
		}
	}
} 
 