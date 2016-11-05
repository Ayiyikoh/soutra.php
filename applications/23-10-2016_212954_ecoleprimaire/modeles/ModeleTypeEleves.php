<?php 
class ModeleTypeEleves{ 
	function creerTypeEleves($typeEleves, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO typeEleves(typeEleve, supprimer) VALUES(:typeEleve, :supprimer)"); 
			$reussite = $creer->execute(array(
				'typeEleve' => $typeEleves->typeEleve,
				'supprimer' => $typeEleves->supprimer)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerTypeEleves : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourTypeEleves($typeEleves, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE typeEleves SET typeEleve=:typeEleve,supprimer=:supprimer WHERE idtypeEleve=:idtypeEleve "); 
			$reussite = $modifier->execute(array(
				'typeEleve' => $typeEleves->typeEleve,
				'supprimer' => $typeEleves->supprimer,
				'idtypeEleve' => $typeEleves->idtypeEleve)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourTypeEleves : ', $ex->getMessage() ; 
		}
	}


	function supprimerTypeEleves($typeEleves, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM typeEleves WHERE idtypeEleve=:idtypeEleve "); 
			$reussite = $supprimer->execute(array(
				'idtypeEleve' => $typeEleves->idtypeEleve)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerTypeEleves : ', $ex->getMessage() ; 
		}
	}


	function trouverTypeEleves($typeEleves, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM typeEleves WHERE idtypeEleve=:idtypeEleve") ; 
			$trouver->execute(array(
				'idtypeEleve' => $typeEleves->idtypeEleve)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTypeEleves : ', $ex->getMessage() ; 
		}
	}


	function trouverTousTypeEleves($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM typeEleves") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTypeEleves : ', $ex->getMessage() ; 
		}
	}
} 
 