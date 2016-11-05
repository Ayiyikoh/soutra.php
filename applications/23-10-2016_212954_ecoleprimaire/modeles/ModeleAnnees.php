<?php 
class ModeleAnnees{ 
	function creerAnnees($annees, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO annees(annee, supprimer) VALUES(:annee, :supprimer)"); 
			$reussite = $creer->execute(array(
				'annee' => $annees->annee,
				'supprimer' => $annees->supprimer)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerAnnees : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourAnnees($annees, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE annees SET annee=:annee,supprimer=:supprimer WHERE idannee=:idannee "); 
			$reussite = $modifier->execute(array(
				'annee' => $annees->annee,
				'supprimer' => $annees->supprimer,
				'idannee' => $annees->idannee)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourAnnees : ', $ex->getMessage() ; 
		}
	}


	function supprimerAnnees($annees, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM annees WHERE idannee=:idannee "); 
			$reussite = $supprimer->execute(array(
				'idannee' => $annees->idannee)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerAnnees : ', $ex->getMessage() ; 
		}
	}


	function trouverAnnees($annees, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM annees WHERE idannee=:idannee") ; 
			$trouver->execute(array(
				'idannee' => $annees->idannee)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverAnnees : ', $ex->getMessage() ; 
		}
	}


	function trouverTousAnnees($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM annees") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverAnnees : ', $ex->getMessage() ; 
		}
	}
} 
 