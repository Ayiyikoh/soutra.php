<?php
require_once("classes/etudiant.php");
require_once("modeles/ModeleEtudiant.php");
require_once("configurations/connexionBD.php");
// test create
//creation d'un objet étudiant
/*$etudiant = new Etudiant();
$etudiant->matricule = "mat";
$etudiant->nom = "Nom";
$etudiant->prenom = "Prenom";
$etudiant->dateNaiss = "date";
$etudiant->lieurNaiss ="ville" ;
// creation d'un objet modele etudiant
$modeleEtudiant = new ModeleEtudiant();
// on cree l'etudiant
$modeleEtudiant->creerEtudiant($etudiant,$bd);

// test update
$etudiant = new Etudiant();
$etudiant->id = 1;
$etudiant->matricule = "mat1";
$etudiant->nom = "nouveau Nom1"; // mise a jour du nom
$etudiant->prenom = "Prenom1";
$etudiant->dateNaiss = "date1";
$etudiant->lieurNaiss ="nouvelle ville1" ; // mise a jour de la ville
// creation d'un objet modele etudiant
$modeleEtudiant = new ModeleEtudiant();
// on met a jour l'etudiant
$modeleEtudiant->mettreAjourEtudiant($etudiant,$bd);

// test read pour un enregistrement identifié par son id
// creation d'un objet modele etudiant
$modeleEtudiant = new ModeleEtudiant();
$etudiant = new Etudiant();
$etudiant->id = 1;
$student = $modeleEtudiant->trouverEtudiant($etudiant,$bd);
  foreach ($student as $value) {
    echo $value['id']." ".$value['matricule']." ".$value['nom']." ".
    $value['prenom']." ".$value['dateNaiss']." ".$value['lieurNaiss']."\n";
  }

//test read pour tous les enregistrements
$modeleEtudiant = new ModeleEtudiant();
$students = $modeleEtudiant->trouverTousEtudiant($bd);
  foreach ($students as $value) {
    echo $value['id']." ".$value['matricule']." ".$value['nom']." ".
    $value['prenom']." ".$value['dateNaiss']." ".$value['lieurNaiss']."\n";
  }
*/
// test delete
$modeleEtudiant = new ModeleEtudiant();
$etudiant = new Etudiant();
$etudiant->id = 1;
$student = $modeleEtudiant->supprimerEtudiant($etudiant,$bd);
?>
