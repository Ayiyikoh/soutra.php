<?php 
class ModeleFacturation{ 
	function creerFacturation($facturation, $bd) { 
		try { 
			$creer = $bd->prepare("INSERT INTO facturation(idtranche, operateursource, operateurdestination, cout, supprime) VALUES(:idtranche, :operateursource, :operateurdestination, :cout, :supprime)"); 
			$reussite = $creer->execute(array(
				'idtranche' => $facturation->idtranche,
				'operateursource' => $facturation->operateursource,
				'operateurdestination' => $facturation->operateurdestination,
				'cout' => $facturation->cout,
				'supprime' => $facturation->supprime)) ;
			$creer->closeCursor() ; 
			if($reussite) { 
				$id = $bd->lastInsertId() ; 
				return $id ; 
			} 
		} catch(Exception $ex) { 
			echo 'Erreur creerFacturation : ', $ex->getMessage() ; 
		}
	}


	function mettreAjourFacturation($facturation, $bd) { 
		try { 
			$modifier = $bd->prepare("UPDATE facturation SET idtranche=:idtranche,operateursource=:operateursource,operateurdestination=:operateurdestination,cout=:cout,supprime=:supprime WHERE idfacturation=:idfacturation "); 
			$reussite = $modifier->execute(array(
				'idtranche' => $facturation->idtranche,
				'operateursource' => $facturation->operateursource,
				'operateurdestination' => $facturation->operateurdestination,
				'cout' => $facturation->cout,
				'supprime' => $facturation->supprime,
				'idfacturation' => $facturation->idfacturation)) ; 
			$modifier->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur mettreAjourFacturation : ', $ex->getMessage() ; 
		}
	}


	function supprimerFacturation($facturation, $bd) { 
		try { 
			$supprimer = $bd->prepare("DELETE FROM facturation WHERE idfacturation=:idfacturation "); 
			$reussite = $supprimer->execute(array(
				'idfacturation' => $facturation->idfacturation)); 
			$supprimer->closeCursor() ; 
			return $reussite ; 
		} catch(Exception $ex) { 
			echo 'Erreur supprimerFacturation : ', $ex->getMessage() ; 
		}
	}


	function trouverFacturation($facturation, $bd) { 
		try { 
			$trouver = $bd->prepare("SELECT * FROM facturation WHERE idfacturation=:idfacturation") ; 
			$trouver->execute(array(
				'idfacturation' => $facturation->idfacturation)); 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverFacturation : ', $ex->getMessage() ; 
		}
	}


	function trouverTousFacturation($bd) { 
		try { 
			$trouver = $bd->query("SELECT * FROM facturation") ; 
			$rows = $trouver->fetchAll() ; 
			$trouver->closeCursor() ; 
			return $rows ; 
		} catch(Exception $ex) { 
			echo 'Erreur trouverFacturation : ', $ex->getMessage() ; 
		}
	}
} 
 