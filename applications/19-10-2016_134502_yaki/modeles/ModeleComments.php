<?php 
class ModeleComments{ 
	function creerComments($comments, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO comments(idSubject, idUser, comment) VALUES(:idSubject, :idUser, :comment)"); 
			$reussite = $creer->execute(array(
				'idSubject' => $comments->idSubject,
				'idUser' => $comments->idUser,
				'comment' => $comments->comment)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerComments : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourComments($comments, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE comments SET idSubject=:idSubject,idUser=:idUser,comment=:comment WHERE idComment=:idComment "); 
			$reussite = $modifier->execute(array(
				'idSubject' => $comments->idSubject,
				'idUser' => $comments->idUser,
				'comment' => $comments->comment,
				'idComment' => $comments->idComment)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourComments : ', $ex->getMessage() ; 
		}
	}


	function supprimerComments($comments, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM comments WHERE idComment=:idComment "); 
			$reussite = $supprimer->execute(array(
				'idComment' => $comments->idComment)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerComments : ', $ex->getMessage() ; 
		}
	}


	function trouverComments($comments, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM comments WHERE idComment=:idComment") ; 
			$trouver->execute(array(
				'idComment' => $comments->idComment)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverComments : ', $ex->getMessage() ; 
		}
	}


	function trouverTousComments($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM comments") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverComments : ', $ex->getMessage() ; 
		}
	}
} 
 