<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter--><?php

	// Détruit toutes les variables d'une session
	session_unset();

	// Initialisation une variable erreur
	$ErreurConnexion = '';

	// Charge la page inscription
	include_once "view/Inscription.php";
?>