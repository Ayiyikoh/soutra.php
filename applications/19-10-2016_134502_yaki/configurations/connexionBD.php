<?php 
	$bd = null ; 

	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION ; 
		$bd = new PDO('mysql:dbname=yaki; host=localhost', 'root', 'linuxroot', $pdo_options) ; 
	} 
	catch(Exception $e){
		die('Erreur : '.$e->getMessage()) ; 
	}