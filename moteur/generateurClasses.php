
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

try{
	$q = $bd->query('show tables') ; /* recupere les diferrents tables */

	if(strtolower(php_sapi_name())=='cli' && empty($_SERVER['remote_addr'])) print("\n-------Création des classes--------\n") ;

	while($d = $q->fetch()){
		$contenu = "class ".ucfirst($d[0])." {\n" ; /* entete de chaque class crée */

		$r = $bd->query('desc '.$d[0]) ; /* recupere les champs dans les tables */
		while($ds = $r->fetch()){
			$contenu = $contenu."\tvar $".$ds[0]." ;\n" ;
		}
		$r->closeCursor() ;
		/* creation de la classe */
		creerClasse($d[0],$contenu) ;
	}

	$q->closeCursor() ;

	if(strtolower(php_sapi_name())=='cli' && empty($_SERVER['remote_addr'])) print("\n\t\tGénération des classes .......... \e[32m OK \e[0m \n") ;
}
catch(Exception $e){
	die("Une erreur s'est produite : erreur : ".$e->getMessage()) ;
}
