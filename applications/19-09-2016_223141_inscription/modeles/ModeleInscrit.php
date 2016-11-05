<?php 
class ModeleInscrit{ 
	function creerInscrit($inscrit, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO inscrit(nom, prenom, cel, mail, fonction, utilsationLinux, supprime) VALUES(:nom, :prenom, :cel, :mail, :fonction, :utilsationLinux, :supprime)"); 
			$reussite = $creer->execute(array(
				'nom' => $inscrit->nom,
				'prenom' => $inscrit->prenom,
				'cel' => $inscrit->cel,
				'mail' => $inscrit->mail,
				'fonction' => $inscrit->fonction,
				'utilsationLinux' => $inscrit->utilsationLinux,
				'supprime' => $inscrit->supprime)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerInscrit : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourInscrit($inscrit, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE inscrit SET nom=:nom,prenom=:prenom,cel=:cel,mail=:mail,fonction=:fonction,utilsationLinux=:utilsationLinux,supprime=:supprime WHERE idinscrit=:idinscrit "); 
			$reussite = $modifier->execute(array(
				'nom' => $inscrit->nom,
				'prenom' => $inscrit->prenom,
				'cel' => $inscrit->cel,
				'mail' => $inscrit->mail,
				'fonction' => $inscrit->fonction,
				'utilsationLinux' => $inscrit->utilsationLinux,
				'supprime' => $inscrit->supprime,
				'idinscrit' => $inscrit->idinscrit)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourInscrit : ', $ex->getMessage() ; 
		}
	}


	function supprimerInscrit($inscrit, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM inscrit WHERE idinscrit=:idinscrit "); 
			$reussite = $supprimer->execute(array(
				'idinscrit' => $inscrit->idinscrit)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerInscrit : ', $ex->getMessage() ; 
		}
	}


	function trouverInscrit($inscrit, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM inscrit WHERE idinscrit=:idinscrit") ; 
			$trouver->execute(array(
				'idinscrit' => $inscrit->idinscrit)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverInscrit : ', $ex->getMessage() ; 
		}
	}


	function trouverTousInscrit($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM inscrit") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverInscrit : ', $ex->getMessage() ; 
		}
	}
} 
 