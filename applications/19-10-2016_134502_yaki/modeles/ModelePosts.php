<?php 
class ModelePosts{ 
	function creerPosts($posts, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO posts(idUser, postContent, tag, datePost, media) VALUES(:idUser, :postContent, :tag, :datePost, :media)"); 
			$reussite = $creer->execute(array(
				'idUser' => $posts->idUser,
				'postContent' => $posts->postContent,
				'tag' => $posts->tag,
				'datePost' => $posts->datePost,
				'media' => $posts->media)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerPosts : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourPosts($posts, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE posts SET idUser=:idUser,postContent=:postContent,tag=:tag,datePost=:datePost,media=:media WHERE idPost=:idPost "); 
			$reussite = $modifier->execute(array(
				'idUser' => $posts->idUser,
				'postContent' => $posts->postContent,
				'tag' => $posts->tag,
				'datePost' => $posts->datePost,
				'media' => $posts->media,
				'idPost' => $posts->idPost)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourPosts : ', $ex->getMessage() ; 
		}
	}


	function supprimerPosts($posts, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM posts WHERE idPost=:idPost "); 
			$reussite = $supprimer->execute(array(
				'idPost' => $posts->idPost)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerPosts : ', $ex->getMessage() ; 
		}
	}


	function trouverPosts($posts, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM posts WHERE idPost=:idPost") ; 
			$trouver->execute(array(
				'idPost' => $posts->idPost)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverPosts : ', $ex->getMessage() ; 
		}
	}


	function trouverTousPosts($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM posts") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverPosts : ', $ex->getMessage() ; 
		}
	}
} 
 