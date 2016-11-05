<?php 
class ModeleUsers{ 
	function creerUsers($users, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO users(pseudo, motPasse, institutionName, siteWeb, telephone, mail, dateInsciption, type) VALUES(:pseudo, :motPasse, :institutionName, :siteWeb, :telephone, :mail, :dateInsciption, :type)"); 
			$reussite = $creer->execute(array(
				'pseudo' => $users->pseudo,
				'motPasse' => $users->motPasse,
				'institutionName' => $users->institutionName,
				'siteWeb' => $users->siteWeb,
				'telephone' => $users->telephone,
				'mail' => $users->mail,
				'dateInsciption' => $users->dateInsciption,
				'type' => $users->type)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerUsers : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourUsers($users, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE users SET pseudo=:pseudo,motPasse=:motPasse,institutionName=:institutionName,siteWeb=:siteWeb,telephone=:telephone,mail=:mail,dateInsciption=:dateInsciption,type=:type WHERE idUser=:idUser "); 
			$reussite = $modifier->execute(array(
				'pseudo' => $users->pseudo,
				'motPasse' => $users->motPasse,
				'institutionName' => $users->institutionName,
				'siteWeb' => $users->siteWeb,
				'telephone' => $users->telephone,
				'mail' => $users->mail,
				'dateInsciption' => $users->dateInsciption,
				'type' => $users->type,
				'idUser' => $users->idUser)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourUsers : ', $ex->getMessage() ; 
		}
	}


	function supprimerUsers($users, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM users WHERE idUser=:idUser "); 
			$reussite = $supprimer->execute(array(
				'idUser' => $users->idUser)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerUsers : ', $ex->getMessage() ; 
		}
	}


	function trouverUsers($users, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM users WHERE idUser=:idUser") ; 
			$trouver->execute(array(
				'idUser' => $users->idUser)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverUsers : ', $ex->getMessage() ; 
		}
	}


	function trouverTousUsers($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM users") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverUsers : ', $ex->getMessage() ; 
		}
	}
} 
 