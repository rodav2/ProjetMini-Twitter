<!--
AUTEUR: Guerry David
DATE DE DEBUT: 09-03-2015
PROJET LicencePro Updago-->

<?php

//*********************************************************************************************************************************************
//************************************************************  Fonction auto chargement des classes   ****************************************
//*********************************************************************************************************************************************
/**
* [Permet d'inclut la classe correspondante au paramètre passé.]
* @param  [type] $classe [nom de la classe]
* @return [type]         [varchar]
*/
function chargerClasse($classe)
{

  require './model/'.$classe .'.class.php'; 
}

// On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.
spl_autoload_register('chargerClasse');


//*********************************************************************************************************************************************
//************************************************************  Connexion à la BDD   **********************************************************
//*********************************************************************************************************************************************

// Connexion à la base de données
$BaseDeDonnees = Utilitaire::Connexion();
$dbh = new PDO("mysql:host=localhost;dbname=twitter", 'root', '', NULL);

//*********************************************************************************************************************************************
//************************************************************  Session start   ***************************************************************
//*********************************************************************************************************************************************
session_start();