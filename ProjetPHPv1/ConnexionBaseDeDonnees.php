<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<?php
	// Permet l'affichage des accents
	header('Content-Type: text/html; charset=UTF-8');
	
	try
	{
		// Requête permettant la connection à la base de données MySQL (nom de BDD, identifiant Mysql, MDP Mysql)
		$BaseDeDonnees = new PDO('mysql:host=localhost;dbname=twitter', 'root', '');
	}
	catch(Exception $erreur)
	{
		// En cas d'erreur, on affiche un message
			echo 'Impossible de se connecter à la base de données<br/>';
			die('Erreur : '.$erreur->getMessage());
			exit();
	}
?>