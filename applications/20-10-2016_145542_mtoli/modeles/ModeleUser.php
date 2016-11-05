<?php 
class ModeleUser{ 
	function creerUser($user, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO user(nom, prenom, email, contact, login, motdepasse, etat, supprime) VALUES(:nom, :prenom, :email, :contact, :login, :motdepasse, :etat, :supprime)"); 
			$reussite = $creer->execute(array(
				'nom' => $user->nom,
				'prenom' => $user->prenom,
				'email' => $user->email,
				'contact' => $user->contact,
				'login' => $user->login,
				'motdepasse' => $user->motdepasse,
				'etat' => $user->etat,
				'supprime' => $user->supprime)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerUser : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourUser($user, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE user SET nom=:nom,prenom=:prenom,email=:email,contact=:contact,login=:login,motdepasse=:motdepasse,etat=:etat,supprime=:supprime WHERE iduser=:iduser "); 
			$reussite = $modifier->execute(array(
				'nom' => $user->nom,
				'prenom' => $user->prenom,
				'email' => $user->email,
				'contact' => $user->contact,
				'login' => $user->login,
				'motdepasse' => $user->motdepasse,
				'etat' => $user->etat,
				'supprime' => $user->supprime,
				'iduser' => $user->iduser)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourUser : ', $ex->getMessage() ; 
		}
	}


	function supprimerUser($user, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM user WHERE iduser=:iduser "); 
			$reussite = $supprimer->execute(array(
				'iduser' => $user->iduser)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerUser : ', $ex->getMessage() ; 
		}
	}


	function trouverUser($user, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM user WHERE iduser=:iduser") ; 
			$trouver->execute(array(
				'iduser' => $user->iduser)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverUser : ', $ex->getMessage() ; 
		}
	}


	function trouverTousUser($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM user") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverUser : ', $ex->getMessage() ; 
		}
	}
} 
 