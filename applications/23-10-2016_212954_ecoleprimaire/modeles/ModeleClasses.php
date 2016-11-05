<?php 
class ModeleClasses{ 
	function creerClasses($classes, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO classes(idannee, classe, supprimer) VALUES(:idannee, :classe, :supprimer)"); 
			$reussite = $creer->execute(array(
				'idannee' => $classes->idannee,
				'classe' => $classes->classe,
				'supprimer' => $classes->supprimer)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerClasses : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourClasses($classes, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE classes SET idannee=:idannee,classe=:classe,supprimer=:supprimer WHERE idclasse=:idclasse "); 
			$reussite = $modifier->execute(array(
				'idannee' => $classes->idannee,
				'classe' => $classes->classe,
				'supprimer' => $classes->supprimer,
				'idclasse' => $classes->idclasse)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourClasses : ', $ex->getMessage() ; 
		}
	}


	function supprimerClasses($classes, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM classes WHERE idclasse=:idclasse "); 
			$reussite = $supprimer->execute(array(
				'idclasse' => $classes->idclasse)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerClasses : ', $ex->getMessage() ; 
		}
	}


	function trouverClasses($classes, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM classes WHERE idclasse=:idclasse") ; 
			$trouver->execute(array(
				'idclasse' => $classes->idclasse)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverClasses : ', $ex->getMessage() ; 
		}
	}


	function trouverTousClasses($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM classes") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverClasses : ', $ex->getMessage() ; 
		}
	}
} 
 