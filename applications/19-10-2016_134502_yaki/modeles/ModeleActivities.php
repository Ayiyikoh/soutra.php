<?php 
class ModeleActivities{ 
	function creerActivities($activities, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO activities(idUser, idContent, activitie, activitieType, date) VALUES(:idUser, :idContent, :activitie, :activitieType, :date)"); 
			$reussite = $creer->execute(array(
				'idUser' => $activities->idUser,
				'idContent' => $activities->idContent,
				'activitie' => $activities->activitie,
				'activitieType' => $activities->activitieType,
				'date' => $activities->date)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerActivities : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourActivities($activities, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE activities SET idUser=:idUser,idContent=:idContent,activitie=:activitie,activitieType=:activitieType,date=:date WHERE idActivitie=:idActivitie "); 
			$reussite = $modifier->execute(array(
				'idUser' => $activities->idUser,
				'idContent' => $activities->idContent,
				'activitie' => $activities->activitie,
				'activitieType' => $activities->activitieType,
				'date' => $activities->date,
				'idActivitie' => $activities->idActivitie)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourActivities : ', $ex->getMessage() ; 
		}
	}


	function supprimerActivities($activities, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM activities WHERE idActivitie=:idActivitie "); 
			$reussite = $supprimer->execute(array(
				'idActivitie' => $activities->idActivitie)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerActivities : ', $ex->getMessage() ; 
		}
	}


	function trouverActivities($activities, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM activities WHERE idActivitie=:idActivitie") ; 
			$trouver->execute(array(
				'idActivitie' => $activities->idActivitie)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverActivities : ', $ex->getMessage() ; 
		}
	}


	function trouverTousActivities($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM activities") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverActivities : ', $ex->getMessage() ; 
		}
	}
} 
 