<?php 
class ModeleTransfert{ 
	function creerTransfert($transfert, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO transfert(iduser, idagent, source, destination, datetransfert, montant, statut, supprime) VALUES(:iduser, :idagent, :source, :destination, :datetransfert, :montant, :statut, :supprime)"); 
			$reussite = $creer->execute(array(
				'iduser' => $transfert->iduser,
				'idagent' => $transfert->idagent,
				'source' => $transfert->source,
				'destination' => $transfert->destination,
				'datetransfert' => $transfert->datetransfert,
				'montant' => $transfert->montant,
				'statut' => $transfert->statut,
				'supprime' => $transfert->supprime)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerTransfert : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourTransfert($transfert, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE transfert SET iduser=:iduser,idagent=:idagent,source=:source,destination=:destination,datetransfert=:datetransfert,montant=:montant,statut=:statut,supprime=:supprime WHERE idtransfert=:idtransfert "); 
			$reussite = $modifier->execute(array(
				'iduser' => $transfert->iduser,
				'idagent' => $transfert->idagent,
				'source' => $transfert->source,
				'destination' => $transfert->destination,
				'datetransfert' => $transfert->datetransfert,
				'montant' => $transfert->montant,
				'statut' => $transfert->statut,
				'supprime' => $transfert->supprime,
				'idtransfert' => $transfert->idtransfert)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourTransfert : ', $ex->getMessage() ; 
		}
	}


	function supprimerTransfert($transfert, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM transfert WHERE idtransfert=:idtransfert "); 
			$reussite = $supprimer->execute(array(
				'idtransfert' => $transfert->idtransfert)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerTransfert : ', $ex->getMessage() ; 
		}
	}


	function trouverTransfert($transfert, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM transfert WHERE idtransfert=:idtransfert") ; 
			$trouver->execute(array(
				'idtransfert' => $transfert->idtransfert)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTransfert : ', $ex->getMessage() ; 
		}
	}


	function trouverTousTransfert($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM transfert") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverTransfert : ', $ex->getMessage() ; 
		}
	}
} 
 