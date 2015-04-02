<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<?php
	// Détruit toutes les variables d'une session
	session_unset();

	// Initialise une variable erreur
	$ErreurConnexion = "";

	// Charge la page connexion
	include_once "view/Connexion.php";
?>