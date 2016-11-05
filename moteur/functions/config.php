
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

	function creerConnexion($serveur, $nom_bd, $utilisateur, $mot_de_passe){

		$deb = "<?php \n" ;

		$etreMalin = "pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION ;" ;

		$l1 = "\t\$bd = null ; \n\n" ;
		$l2 = "\ttry{\n" ;
		$l3 = "\t\t\$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION ; \n" ;
		$l4 = "\t\t\$bd = new PDO('mysql:dbname=$nom_bd; host=$serveur', '$utilisateur', '$mot_de_passe', \$pdo_options) ; \n" ;
		$l5 = "\t} \n" ;
		$l6 = "\tcatch(Exception \$e){\n" ;
		$l7 = "\t\tdie('Erreur : '.\$e->getMessage()) ; \n" ;
		$l8 = "\t}" ;

		return $deb.$l1.$l2.$l3.$l4.$l5.$l6.$l7.$l8 ;

	}
