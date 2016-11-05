
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

function creerClasse($nomTable,$contenu){
	$deb = "<?php \n" ;
	$fin = "} \n ?>" ;
	$fichier = $deb.$contenu.$fin ;
	$folder = $_SESSION['folder'] ;
	/* verification de l'existence de dossier class */
	if(!is_dir($folder."/classes")) mkdir($folder."/classes") ;
	/* creation physique de la classe */
	$f = fopen($folder.'/classes/'.$nomTable.'.php', 'w+') ;
	fclose($f) ;
	file_put_contents($folder.'/classes/'.$nomTable.'.php', $fichier) ;
	/* ajout du retour à la ligne selon que le script est executé depuis un navigateur ou le cli */
	$c = (strtolower(php_sapi_name())=='cli' && empty($_SERVER['remote_addr'])) ? " .......... \e[32m créée ! \e[0m \n" : " créée !<br>" ;
	/* affichage du message de succès à l'utilisateur avec le retour à la ligne */
	echo "classe ".$nomTable.$c ;
}
