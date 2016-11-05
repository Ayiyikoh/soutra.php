<?php 
class ModeleTags{ 
	function creerTags($tags, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO tags(tagName) VALUES(:tagName)"); 
			$reussite = $creer->execute(array(
				'tagName' => $tags->tagName)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerTags : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourTags($tags, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE tags SET tagName=:tagName WHERE idTag=:idTag "); 
			$reussite = $modifier->execute(array(
				'tagName' => $tags->tagName,
				'idTag' => $tags->idTag)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourTags : ', $ex->getMessage() ; 
		}
	}


	function supprimerTags($tags, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM tags WHERE idTag=:idTag "); 
			$reussite = $supprimer->execute(array(
				'idTag' => $tags->idTag)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerTags : ', $ex->getMessage() ; 
		}
	}


	function trouverTags($tags, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM tags WHERE idTag=:idTag") ; 
			$trouver->execute(array(
				'idTag' => $tags->idTag)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTags : ', $ex->getMessage() ; 
		}
	}


	function trouverTousTags($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM tags") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTags : ', $ex->getMessage() ; 
		}
	}
} 
 