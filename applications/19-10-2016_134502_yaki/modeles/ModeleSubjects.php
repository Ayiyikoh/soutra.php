<?php 
class ModeleSubjects{ 
	function creerSubjects($subjects, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO subjects(idUser, tag, subjectContent, datePostSubject) VALUES(:idUser, :tag, :subjectContent, :datePostSubject)"); 
			$reussite = $creer->execute(array(
				'idUser' => $subjects->idUser,
				'tag' => $subjects->tag,
				'subjectContent' => $subjects->subjectContent,
				'datePostSubject' => $subjects->datePostSubject)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerSubjects : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourSubjects($subjects, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE subjects SET idUser=:idUser,tag=:tag,subjectContent=:subjectContent,datePostSubject=:datePostSubject WHERE idSubject=:idSubject "); 
			$reussite = $modifier->execute(array(
				'idUser' => $subjects->idUser,
				'tag' => $subjects->tag,
				'subjectContent' => $subjects->subjectContent,
				'datePostSubject' => $subjects->datePostSubject,
				'idSubject' => $subjects->idSubject)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourSubjects : ', $ex->getMessage() ; 
		}
	}


	function supprimerSubjects($subjects, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM subjects WHERE idSubject=:idSubject "); 
			$reussite = $supprimer->execute(array(
				'idSubject' => $subjects->idSubject)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerSubjects : ', $ex->getMessage() ; 
		}
	}


	function trouverSubjects($subjects, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM subjects WHERE idSubject=:idSubject") ; 
			$trouver->execute(array(
				'idSubject' => $subjects->idSubject)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverSubjects : ', $ex->getMessage() ; 
		}
	}


	function trouverTousSubjects($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM subjects") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverSubjects : ', $ex->getMessage() ; 
		}
	}
} 
 