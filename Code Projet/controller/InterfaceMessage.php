<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<?php

	// Redirection si utilisateur non connecter
	if($_SESSION['idUtilisateur'] == null)	
	{
		header('Location:index.php');  		
	}

	// Declaration d'une variable erreur
	$ErreurConnexion = "";

	// Permet d'affciher les messages des abonnees
	$Messages = Message::AfficherMessageAbonne($_SESSION['idUtilisateur']);

	// Permet d'afficher les messages de l'utilisateur connecté
	$MessagesUtilisateur = Message::AfficherMessageUtilisateur($_SESSION['idUtilisateur']);

	// Permet de recuperer la listes des utilisateurs à suivre
	$UtilisateurASuivre = Utilisateur::RecupererUtilisateursNonSuivi($_SESSION['idUtilisateur']);

	// Permet de recuperer la listes des utilisateurs suivi pas l'utilisateur connecté
	$UtilisateurSuivi = Utilisateur::UtilisateursSuivi($_SESSION['idUtilisateur']);

	// Permet le chargement de l'icon Homme/Femme selon le sexe
	if($_SESSION['Sexe'] == 1){
		$IconeSexe = "<img class='Icone' src='image/homme.jpg' alt='Icone homme'>";
	}else{
		$IconeSexe = "<img class='Icone' src='image/femme.jpg' alt='Icone femme'>";
	}	
	
	// Charge la page interface message
	include_once "view/InterfaceMessage.php";
?>
