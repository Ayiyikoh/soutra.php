<?php 
class ModeleTypeDepenses{ 
	function creerTypeDepenses($typeDepenses, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO typeDepenses(typeDepense, supprimer) VALUES(:typeDepense, :supprimer)"); 
			$reussite = $creer->execute(array(
				'typeDepense' => $typeDepenses->typeDepense,
				'supprimer' => $typeDepenses->supprimer)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerTypeDepenses : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourTypeDepenses($typeDepenses, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE typeDepenses SET typeDepense=:typeDepense,supprimer=:supprimer WHERE idtypeDepense=:idtypeDepense "); 
			$reussite = $modifier->execute(array(
				'typeDepense' => $typeDepenses->typeDepense,
				'supprimer' => $typeDepenses->supprimer,
				'idtypeDepense' => $typeDepenses->idtypeDepense)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourTypeDepenses : ', $ex->getMessage() ; 
		}
	}


	function supprimerTypeDepenses($typeDepenses, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM typeDepenses WHERE idtypeDepense=:idtypeDepense "); 
			$reussite = $supprimer->execute(array(
				'idtypeDepense' => $typeDepenses->idtypeDepense)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerTypeDepenses : ', $ex->getMessage() ; 
		}
	}


	function trouverTypeDepenses($typeDepenses, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM typeDepenses WHERE idtypeDepense=:idtypeDepense") ; 
			$trouver->execute(array(
				'idtypeDepense' => $typeDepenses->idtypeDepense)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTypeDepenses : ', $ex->getMessage() ; 
		}
	}


	function trouverTousTypeDepenses($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM typeDepenses") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTypeDepenses : ', $ex->getMessage() ; 
		}
	}
} 
 