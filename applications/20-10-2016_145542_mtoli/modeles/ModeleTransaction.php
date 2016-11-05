<?php 
class ModeleTransaction{ 
	function creerTransaction($transaction, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO transaction(iduser, idagent, source, datetransaction, montant, statut, supprime) VALUES(:iduser, :idagent, :source, :datetransaction, :montant, :statut, :supprime)"); 
			$reussite = $creer->execute(array(
				'iduser' => $transaction->iduser,
				'idagent' => $transaction->idagent,
				'source' => $transaction->source,
				'datetransaction' => $transaction->datetransaction,
				'montant' => $transaction->montant,
				'statut' => $transaction->statut,
				'supprime' => $transaction->supprime)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerTransaction : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourTransaction($transaction, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE transaction SET iduser=:iduser,idagent=:idagent,source=:source,datetransaction=:datetransaction,montant=:montant,statut=:statut,supprime=:supprime WHERE idtransaction=:idtransaction "); 
			$reussite = $modifier->execute(array(
				'iduser' => $transaction->iduser,
				'idagent' => $transaction->idagent,
				'source' => $transaction->source,
				'datetransaction' => $transaction->datetransaction,
				'montant' => $transaction->montant,
				'statut' => $transaction->statut,
				'supprime' => $transaction->supprime,
				'idtransaction' => $transaction->idtransaction)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourTransaction : ', $ex->getMessage() ; 
		}
	}


	function supprimerTransaction($transaction, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM transaction WHERE idtransaction=:idtransaction "); 
			$reussite = $supprimer->execute(array(
				'idtransaction' => $transaction->idtransaction)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerTransaction : ', $ex->getMessage() ; 
		}
	}


	function trouverTransaction($transaction, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM transaction WHERE idtransaction=:idtransaction") ; 
			$trouver->execute(array(
				'idtransaction' => $transaction->idtransaction)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTransaction : ', $ex->getMessage() ; 
		}
	}


	function trouverTousTransaction($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM transaction") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTransaction : ', $ex->getMessage() ; 
		}
	}
} 
 