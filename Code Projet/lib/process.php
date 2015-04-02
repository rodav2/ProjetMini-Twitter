<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<?php
//*********************************************************************************************************************************************
//************************************************************  PARTIE AUTHENTIFICATION   *****************************************************
//*********************************************************************************************************************************************

	// Connexion d'un utilisateur
	if(isset($_POST['ValiderConnexion']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{
		// Récupere les valeurs saisie
		$Login = $_POST['Identifiant'];
		$MDP = sha1($_POST['MotDePasse']);
	   
		// Utilise la fonction de connexion de la classe utilisateur
		Utilisateur::ConnexionUtilisateur($Login, $MDP);

		// Termine le traitement de la requête
		$Requete->closeCursor(); 
	}
	
	// Deconnexion d'un utilisateur
	if(isset($_POST['Deconnexion']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{
		Utilitaire::Deconnexion();
	}

//*********************************************************************************************************************************************
//************************************************************  PARTIE MESSAGE   **************************************************************
//*********************************************************************************************************************************************

	// Poster un message
	if(isset($_POST['Envoyer']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{

		$Messages = $_POST['EcrireMessage'];
		$DateCourante = date("Y-m-d H:i");
		$idUtilisateur = $_SESSION['idUtilisateur'];

		// Verification du champs message non vide
		if($Messages == null)
		{
			echo "<script language=\"JavaScript\">
			alert(\"Le champ message est vide !\")
			document.location.href=\"index.php?page=InterfaceMessage\"
			</script>";
			

		}else{

			// Appel de la fontion permetant la creation de message
			$ResultatInsertion = Message::CreationMessage($Messages, $DateCourante, $idUtilisateur);

			// Traitement des données	
			if($ResultatInsertion == true)	
			{	
				echo "<script language=\"JavaScript\">
				alert(\"Message enregistré !\")
				document.location.href=\"index.php?page=InterfaceMessage\"
				</script>";	

			}
			else
			{
				echo "<script language=\"JavaScript\">
				alert(\"Erreur lors de l'enregistrement du message !\")
				document.location.href=\"index.php?page=InterfaceMessage\"
				</script>";			
			}
		}
	}

	// Supprimer un message 
	if(isset($_POST['Supprimer']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{
			
		if(!isset($_POST['MessageEnvoye']))
		{
			echo "<script language=\"JavaScript\">
			alert(\"Suppression impossible : Aucun message selectionné !\")
			document.location.href=\"index.php?page=InterfaceMessage\"
			</script>";	
			
		}
		else 
		{
			foreach($_POST['MessageEnvoye'] as $valeur)
			{				
					$Message = Message::SuppressionMessage($valeur);

					echo "<script language=\"JavaScript\">
					alert(\"Message(s) bien supprimé !\")
					document.location.href=\"index.php?page=InterfaceMessage\"
					</script>";	
			}
		}	
	}

	// Modifier un message
	if(isset($_POST['Modifier']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{
		if(!isset($_POST['MessageEnvoye']))
		{
			echo "<script language=\"JavaScript\">
			alert(\"Modification impossible : Aucun message selectionné !\")
			document.location.href=\"index.php?page=InterfaceMessage\"
			</script>";	
			
		}
		else if ($_POST['EcrireMessage'] == null){

			echo "<script language=\"JavaScript\">
			alert(\"Modification impossible : Aucun message ecrit\")
			document.location.href=\"index.php?page=InterfaceMessage\"
			</script>";	
			
		}
		else 
		{
			foreach($_POST['MessageEnvoye'] as $valeur)
			{

				$Message = $_POST['EcrireMessage'];
				$Date = date("Y-m-d H:i");
				$idUtilisateur = $_SESSION['idUtilisateur'];

				Message::ModifierMessage($valeur, $Message, $Date, $idUtilisateur);

				echo "<script language=\"JavaScript\">
				alert(\"Message(s) bien modifier !\")
				document.location.href=\"index.php?page=InterfaceMessage\"
				</script>";	
			}
		}	
	}

//*********************************************************************************************************************************************
//************************************************************  PARTIE UTILISATEUR   **********************************************************
//*********************************************************************************************************************************************

	// S'abonner a un utilisateur
	if(isset($_POST['Suivre']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{
		if(!isset($_POST['AfficherUtilisateurs']))
		{
			echo "<script language=\"JavaScript\">
			alert(\"Abonnement impossible : Aucun utilisateur selectionné !\")
			document.location.href=\"index.php?page=InterfaceMessage\"
			</script>";	
		}
		else 
		{
			foreach($_POST['AfficherUtilisateurs'] as $valeur)
			{	
				$idUtilisateur = $_SESSION['idUtilisateur'];	

				Abonne::SAbonnerAUnUtilisateur($valeur, $idUtilisateur);

				echo "<script language=\"JavaScript\">
				alert(\"Utilisateur suivi !\")
				document.location.href=\"index.php?page=InterfaceMessage\"
				</script>";			
			}
		}	
	}

	// Se desabonner à un utilisateur
	if(isset($_POST['Desabonner']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{
		if(!isset($_POST['AfficherUtilisateursSuivi']))
		{
			echo "<script language=\"JavaScript\">
			alert(\"Desabonnement impossible : Aucun utilisateur selectionné !\")
			document.location.href=\"index.php?page=InterfaceMessage\"
			</script>";	
			
		}
		else 
		{
			foreach($_POST['AfficherUtilisateursSuivi'] as $valeur)
			{			
				$idUtilisateur = $_SESSION['idUtilisateur'];	

				Abonne::DesabonnerAUnUtilisateur($valeur, $idUtilisateur);	

				echo "<script language=\"JavaScript\">
				alert(\"Desabonnement réussit !\")
				document.location.href=\"index.php?page=InterfaceMessage\"
				</script>";		
			}
		}	
	}	

	// Supprimer un compte utilisateur
	if(isset($_POST['SupprimerCompte']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{
		if(!isset($_SESSION['idUtilisateur']))
		{
			echo "<script language=\"JavaScript\">
			alert(\"Suppression impossible : Aucun utilisateur connecté !\")
			document.location.href=\"index.php?page=InterfaceMessage\"
			</script>";	
		}
		else 
		{		
			Utilisateur::SupprimerUtilisateur($_SESSION['idUtilisateur']);

			echo "<script language=\"JavaScript\">
			alert(\"Suppression de votre compte réussit !\")
			document.location.href=\"index.php\"
			</script>";		
		}		
	}

//*********************************************************************************************************************************************
//************************************************************  PARTIE INSCRIPTION   **********************************************************
//*********************************************************************************************************************************************

	// Valider le formulaire d'inscription
	if(isset($_POST['ValiderInscription']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{

		// Récupere les valeurs saisie par l'utilisateur
	    $Login = $_POST['IdentifiantInscription'];
	    $MDP = sha1($_POST['MotDePasseInscription']);
	    $Nom = $_POST['NomInscription'];
	    $Prenom = $_POST['PrenomInscription'];
	    $Confirmation = sha1($_POST['ConfirmationInscription']);
	    $Sexe = ($_POST['Sexe'] == "SexeFemme") ? 0 : 1;

	    // Vérification des caractéres saisie dans la zone 'identifiant'
	    if(!preg_match("#^[a-z0-9]{1,20}$#i",$Login)) /* #^ = debut, [a-z0-9] = lettres et chiffres autorisées, {1,20} = minim: 1 caract, maxi: 20 caract*/
	    {
	        echo "<script language=\"JavaScript\">
	        alert(\"Caractére(s) incorrect ou zone de saisie vide !\")
	        document.location.href=\"index.php?page=Inscription\"
	        </script>"; 
	    }
	    //Verifie si les champs ne sont pas vide
	    if($Nom == '' || $Prenom == '' || $Login == '' || $MDP == '' || $Confirmation == '')
	    {
	            echo "<script language=\"JavaScript\">
	            alert(\"L'un des champs est vide !\")
	            document.location.href=\"index.php?page=Inscription\"
	            </script>";  

	    }
	    // Verifie si l'identifiant n'est pas deja utilisé
	    else if(Utilisateur::VerifierLogin($Login))
	    {
	    	echo "<script language=\"JavaScript\">
	        alert(\"Identifiant deja utilisé ! Veuillez le changer !\")
	        document.location.href=\"index.php?page=Inscription\"
	        </script>";
	    }
	    // Verifie la correspondance des mots de passe saisie
	    else if($MDP != $Confirmation)
	    {
	            echo "<script language=\"JavaScript\">
	            alert(\"Mot de passe différent\")
	            document.location.href=\"index.php?page=Inscription\"
	            </script>";
	    }
	    else
	    { 
	    	// Inscrit le nouvel utilisateur 
	    	$ResultatInsertion = Utilisateur::InscriptionUtilisateur($Login, $MDP, $Nom, $Prenom, $Sexe);

	        // Traitement du resultat
	        if($ResultatInsertion == true)  
	        {   
	            echo "<script language=\"JavaScript\">
	            alert(\"Nouvel utilisateur enregistré !\")
	            document.location.href=\"index.php\"
	            </script>"; 
	        }
	        else
	        {
	            echo "<script language=\"JavaScript\">
	            alert(\"Erreur lors de l'enregistrement du nouvel utilisateur !\")
	            document.location.href=\"index.php?page=InterfaceMessage\"         
	            </script>"; 
	        }   
	    }       
	}
?>