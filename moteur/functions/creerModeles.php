
<?php


/**#################################################################
    SOUTRA.PHP , PHP CRUD creator
    Copyright (C) 2016  FABLAB AYIYIKOH, www.ayiyikoh.org
    SOUTRA.PHP is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    SOUTRA.PHP is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with SOUTRA.PHP.  If not, see <http://www.gnu.org/licenses/>.
		fablab@ayiyikoh.org

####################################################################**/


function creerModel($nomTable,$donnees){
	$deb = "<?php \n"."class Modele".ucfirst($nomTable)."{ \n" ;
	$fin = "} \n " ;
	$contenu = array() ;
	$folder = $_SESSION['folder'] ;

	$contenu[] = functionCreer($nomTable,$donnees) ;
	$contenu[] = functionMettreAjour($nomTable,$donnees) ;
	$contenu[] = functionSupprimer($nomTable,$donnees) ;
	$contenu[] = functionTrouver($nomTable,$donnees) ;
	$contenu[] = functionTrouverTous($nomTable,$donnees) ;

	$fichier = $deb.join($contenu,"\n\n").$fin ;
	/* verification de l'existence de dossier modeles */
	if(!is_dir($folder."/modeles")) mkdir($folder."/modeles") ;
	/* creation physique de la classe */
	$f = fopen($folder.'/modeles/Modele'.ucfirst($nomTable).'.php', 'w+') ;
	fclose($f);
	file_put_contents($folder.'/modeles/Modele'.ucfirst($nomTable).'.php', $fichier) ;
	/* ajout du retour à la ligne selon que le script est executé depuis un navigateur ou le cli */
	$c = (strtolower(php_sapi_name())=='cli' && empty($_SERVER['remote_addr'])) ? " .......... \e[32m créé ! \e[0m \n" : " créé !<br>" ;
	/* affichage du message de succès à l'utilisateur avec le retour à la ligne */
	echo "Modele ".$nomTable.$c ;
}




function functionCreer($nomTable,$donnees){
	$t1 = "\t";
	$t2 = "\t\t";
	$t3 = "\t\t\t";
	$t4 = "\t\t\t\t";
	$t5 = "\t\t\t\t\t";
	$t6 = "\t\t\t\t\t\t";

	$l1 = $t1."function creer".ucfirst($nomTable)."($".$nomTable.", \$bd) { \n" ;

	$l2 = $t2."try { \n" ;

		$fields = array() ;
		$values = array() ;
		for($i=1; $i<count($donnees[$nomTable]); $i++){
			$fields[] = $donnees[$nomTable][$i] ;
			$values[] = $donnees[$nomTable][$i] ;
		}

		$fields = join($fields,', ') ;

		$values = join($values,', :') ;
		$values = ':'.$values ;

	$l3 = $t3."\$creer = \$bd->prepare(\"INSERT INTO ".$nomTable."(".$fields.") VALUES(".$values.")\"); \n" ;

		$champValeur = '' ;
		$tabChampValeur = array() ;

		for($i=1; $i<count($donnees[$nomTable]); $i++){
			$tabChampValeur[] = "'".$donnees[$nomTable][$i]."' => $".$nomTable."->".$donnees[$nomTable][$i] ;
		}

		$champValeur = join($tabChampValeur,",\n".$t4) ;
	$l4 = $t3."\$reussite = \$creer->execute(array(\n".$t4.$champValeur.")) ;\n" ;

	$lc = $t3."\$creer->closeCursor() ; \n" ;

	$l5 = $t3."if(\$reussite) { \n" ;

	$l6 = $t4."\$id = \$bd->lastInsertId() ; \n" ;

	$l7 = $t4."return \$id ; \n" ;

	$l8 = $t3."} \n" ;

	$l9 = $t2."} catch(Exception \$ex) { \n" ;

	$l10 = $t3."echo 'Erreur creer".ucfirst($nomTable)." : ', \$ex->getMessage() ; \n" ;

	$l11 = $t2."}\n" ;
	$l12 = $t1."}\n" ;

	return $l1.$l2.$l3.$l4.$lc.$l5.$l6.$l7.$l8.$l9.$l10.$l11.$l12 ;
}

function functionMettreAjour($nomTable,$donnees){
	$t1 = "\t";
	$t2 = "\t\t";
	$t3 = "\t\t\t";
	$t4 = "\t\t\t\t";
	$t5 = "\t\t\t\t\t";
	$t6 = "\t\t\t\t\t\t";

	$l1 = $t1."function mettreAjour".ucfirst($nomTable)."($".$nomTable.", \$bd) { \n" ;

	$l2 = $t2."try { \n" ;

		$fields = array() ;
		for($i=1; $i<count($donnees[$nomTable]); $i++){
			$fields[] = $donnees[$nomTable][$i].'=:'.$donnees[$nomTable][$i] ;
		}
		$predicat = $donnees[$nomTable][0]."=:".$donnees[$nomTable][0] ;
	$l3 = $t3."\$modifier = \$bd->prepare(\"UPDATE ".$nomTable." SET ".join($fields,',')." WHERE ".$predicat." \"); \n" ;

		$tabChampValeur = array() ;
		for($j=1; $j<count($donnees[$nomTable]); $j++){
			$tabChampValeur[] = "'".$donnees[$nomTable][$j]."' => $".$nomTable."->".$donnees[$nomTable][$j] ;
		}
		$tabChampValeur[] = "'".$donnees[$nomTable][0]."' => $".$nomTable."->".$donnees[$nomTable][0] ;
		$champValeur = join($tabChampValeur,",\n".$t4) ;
	$l4 = $t3."\$reussite = \$modifier->execute(array(\n".$t4.$champValeur.")) ; \n" ;

	$lc = $t3."\$modifier->closeCursor() ; \n" ;

	$l5 = $t3."return \$reussite ; \n" ;

	$l6 = "" ;

	$l7 = $t2."} catch(Exception \$ex) { \n" ;

	$l8 = $t3."echo 'Erreur mettreAjour".ucfirst($nomTable)." : ', \$ex->getMessage() ; \n" ;

	$l9 = $t2."}\n" ;
	$l10 = $t1."}\n" ;

	return $l1.$l2.$l3.$l4.$lc.$l5.$l6.$l7.$l8.$l9.$l10 ;
}

function functionSupprimer($nomTable,$donnees){
	$t1 = "\t";
	$t2 = "\t\t";
	$t3 = "\t\t\t";
	$t4 = "\t\t\t\t";
	$t5 = "\t\t\t\t\t";
	$t6 = "\t\t\t\t\t\t";

	$l1 = $t1."function supprimer".ucfirst($nomTable)."($".$nomTable.", \$bd) { \n" ;

	$l2 = $t2."try { \n" ;

		$where = $donnees[$nomTable][0].'=:'.$donnees[$nomTable][0] ;
	$l3 = $t3."\$supprimer = \$bd->prepare(\"DELETE FROM ".$nomTable." WHERE ".$where." \"); \n" ;

		$predicat = "'".$donnees[$nomTable][0]."' => \$".$nomTable."->".$donnees[$nomTable][0] ;
	$l4 = $t3."\$reussite = \$supprimer->execute(array(\n".$t4.$predicat.")); \n" ;

	$lc = $t3."\$supprimer->closeCursor() ; \n" ;

	$l5 = $t3."return \$reussite ; \n" ;

	$l6 = "" ;

	$l7 = $t2."} catch(Exception \$ex) { \n" ;

	$l8 = $t3."echo 'Erreur supprimer".ucfirst($nomTable)." : ', \$ex->getMessage() ; \n" ;

	$l9 = $t2."}\n" ;
	$l10 = $t1."}\n" ;

	return $l1.$l2.$l3.$l4.$lc.$l5.$l6.$l7.$l8.$l9.$l10 ;
}

function functionTrouver($nomTable,$donnees){
	$t1 = "\t";
	$t2 = "\t\t";
	$t3 = "\t\t\t";
	$t4 = "\t\t\t\t";
	$t5 = "\t\t\t\t\t";
	$t6 = "\t\t\t\t\t\t";

	$l1 = $t1."function trouver".ucfirst($nomTable)."($".$nomTable.", \$bd) { \n" ;

	$l2 = $t2."try { \n" ;

		$where = $donnees[$nomTable][0].'=:'.$donnees[$nomTable][0] ;
	$l3 = $t3."\$trouver = \$bd->prepare(\"SELECT * FROM ".$nomTable." WHERE ".$where."\") ; \n" ;

		$predicat = "'".$donnees[$nomTable][0]."' => \$".$nomTable."->".$donnees[$nomTable][0] ;
	$l4 = $t3."\$trouver->execute(array(\n".$t4.$predicat.")); \n" ;

	$l5 = $t3."\$rows = \$trouver->fetchAll() ; \n" ;

	$lc = $t3."\$trouver->closeCursor() ; \n" ;

	$l6 = $t3."return \$rows ; \n" ;

	$l7 = $t2."} catch(Exception \$ex) { \n" ;

	$l8 = $t3."echo 'Erreur trouver".ucfirst($nomTable)." : ', \$ex->getMessage() ; \n" ;

	$l9 = $t2."}\n" ;
	$l10 = $t1."}\n" ;

	return $l1.$l2.$l3.$l4.$l5.$lc.$l6.$l7.$l8.$l9.$l10 ;
}

function functionTrouverTous($nomTable,$donnees){
	$t1 = "\t";
	$t2 = "\t\t";
	$t3 = "\t\t\t";
	$t4 = "\t\t\t\t";
	$t5 = "\t\t\t\t\t";
	$t6 = "\t\t\t\t\t\t";

	$l1 = $t1."function trouverTous".ucfirst($nomTable)."(\$bd) { \n" ;

	$l2 = $t2."try { \n" ;

	$l3 = $t3."\$trouver = \$bd->query(\"SELECT * FROM ".$nomTable."\") ; \n" ;

	$l4 = $t3."\$rows = \$trouver->fetchAll() ; \n" ;

	$lc = $t3."\$trouver->closeCursor() ; \n" ;

	$l5 = $t3."return \$rows ; \n" ;

	$l6 = $t2."} catch(Exception \$ex) { \n" ;

	$l7 = $t3."echo 'Erreur trouver".ucfirst($nomTable)." : ', \$ex->getMessage() ; \n" ;

	$l8 = $t2."}\n" ;
	$l9 = $t1."}\n" ;

	return $l1.$l2.$l3.$l4.$lc.$l5.$l6.$l7.$l8.$l9 ;
}
