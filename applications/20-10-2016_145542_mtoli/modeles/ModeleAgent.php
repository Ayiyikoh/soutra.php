<?php 
class ModeleAgent{ 
	function creerAgent($agent, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO agent(agent, numero, solde, seuil, supprime) VALUES(:agent, :numero, :solde, :seuil, :supprime)"); 
			$reussite = $creer->execute(array(
				'agent' => $agent->agent,
				'numero' => $agent->numero,
				'solde' => $agent->solde,
				'seuil' => $agent->seuil,
				'supprime' => $agent->supprime)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerAgent : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourAgent($agent, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE agent SET agent=:agent,numero=:numero,solde=:solde,seuil=:seuil,supprime=:supprime WHERE idagent=:idagent "); 
			$reussite = $modifier->execute(array(
				'agent' => $agent->agent,
				'numero' => $agent->numero,
				'solde' => $agent->solde,
				'seuil' => $agent->seuil,
				'supprime' => $agent->supprime,
				'idagent' => $agent->idagent)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourAgent : ', $ex->getMessage() ; 
		}
	}


	function supprimerAgent($agent, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM agent WHERE idagent=:idagent "); 
			$reussite = $supprimer->execute(array(
				'idagent' => $agent->idagent)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerAgent : ', $ex->getMessage() ; 
		}
	}


	function trouverAgent($agent, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM agent WHERE idagent=:idagent") ; 
			$trouver->execute(array(
				'idagent' => $agent->idagent)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverAgent : ', $ex->getMessage() ; 
		}
	}


	function trouverTousAgent($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM agent") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverAgent : ', $ex->getMessage() ; 
		}
	}
} 
 