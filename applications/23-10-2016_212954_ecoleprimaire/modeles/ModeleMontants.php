<?php 
class ModeleMontants{ 
	function creerMontants($montants, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO montants(montant, supprimer) VALUES(:montant, :supprimer)"); 
			$reussite = $creer->execute(array(
				'montant' => $montants->montant,
				'supprimer' => $montants->supprimer)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerMontants : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourMontants($montants, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE montants SET montant=:montant,supprimer=:supprimer WHERE idmontant=:idmontant "); 
			$reussite = $modifier->execute(array(
				'montant' => $montants->montant,
				'supprimer' => $montants->supprimer,
				'idmontant' => $montants->idmontant)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourMontants : ', $ex->getMessage() ; 
		}
	}


	function supprimerMontants($montants, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM montants WHERE idmontant=:idmontant "); 
			$reussite = $supprimer->execute(array(
				'idmontant' => $montants->idmontant)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerMontants : ', $ex->getMessage() ; 
		}
	}


	function trouverMontants($montants, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM montants WHERE idmontant=:idmontant") ; 
			$trouver->execute(array(
				'idmontant' => $montants->idmontant)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverMontants : ', $ex->getMessage() ; 
		}
	}


	function trouverTousMontants($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM montants") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverMontants : ', $ex->getMessage() ; 
		}
	}
} 
 