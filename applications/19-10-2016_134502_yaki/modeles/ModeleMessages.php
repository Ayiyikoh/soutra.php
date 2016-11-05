<?php 
class ModeleMessages{ 
	function creerMessages($messages, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO messages(emetteur, destinataire, date, message) VALUES(:emetteur, :destinataire, :date, :message)"); 
			$reussite = $creer->execute(array(
				'emetteur' => $messages->emetteur,
				'destinataire' => $messages->destinataire,
				'date' => $messages->date,
				'message' => $messages->message)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerMessages : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourMessages($messages, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE messages SET emetteur=:emetteur,destinataire=:destinataire,date=:date,message=:message WHERE idMessages=:idMessages "); 
			$reussite = $modifier->execute(array(
				'emetteur' => $messages->emetteur,
				'destinataire' => $messages->destinataire,
				'date' => $messages->date,
				'message' => $messages->message,
				'idMessages' => $messages->idMessages)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourMessages : ', $ex->getMessage() ; 
		}
	}


	function supprimerMessages($messages, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM messages WHERE idMessages=:idMessages "); 
			$reussite = $supprimer->execute(array(
				'idMessages' => $messages->idMessages)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerMessages : ', $ex->getMessage() ; 
		}
	}


	function trouverMessages($messages, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM messages WHERE idMessages=:idMessages") ; 
			$trouver->execute(array(
				'idMessages' => $messages->idMessages)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverMessages : ', $ex->getMessage() ; 
		}
	}


	function trouverTousMessages($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM messages") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverMessages : ', $ex->getMessage() ; 
		}
	}
} 
 