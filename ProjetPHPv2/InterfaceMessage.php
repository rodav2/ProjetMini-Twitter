<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<?PHP

	// Permet d'utiliser les variables sur toutes les pages
	session_start();

	// Initialisation
	$ErreurConnexion = '';
		
	// Inclusion des differentes classes utile
	include_once "Utilitaire.class.php";
	include_once "Utilisateur.class.php";
	include_once "Message.class.php";

	$Message = new Message;

	// Connexion a la base de données
	$BaseDeDonnees = Utilitaire::Connexion();
	
	// Redirection selon le privilege
	if($_SESSION['idUtilisateur'] == null)	
	{
		header('Location:index.php');
	}
	
	// Deconnexion
	if(isset($_POST['Deconnexion']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{
		$deconnexion = new Utilitaire;
		$deconnexion->Deconnexion();
	}

	// Ecrire un message
	if(isset($_POST['Envoyer']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{

		// nl2br() // htmlentities = anti-injection // addslashes = gere les slash
		$Messages = addslashes(nl2br($_POST['EcrireMessage']));
		$DateCourante = date("Y-m-d H:i");
		$idUtilisateur = $_SESSION['idUtilisateur'];

		// Verification du champs message non vide
		if($Messages == null)
		{
			echo "<script language=\"JavaScript\">
			alert(\"Le champ message est vide !\")
			document.location.href=\"InterfaceMessage.php\"
			</script>";
			exit();
		}else{
			$Message->CreationMessage($Messages, $DateCourante, $idUtilisateur);
		}
	}

	// Supprimer les messages "isset=Si l'element existe alors ..."
	if(isset($_POST['Supprimer']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{
			
		if(!isset($_POST['MessageEnvoye']))
		{
			echo "<script language=\"JavaScript\">
			alert(\"Suppression impossible : Aucun message selectionné !\")
			document.location.href=\"InterfaceMessage.php\"
			</script>";	
			exit();
		}
		else 
		{
			foreach($_POST['MessageEnvoye'] as $valeur)
			{				
					$Message = Message::SuppressionMessage($valeur);
		
			}
		}	
	}


	// Modifier un message
	if(isset($_POST['Modifier']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{
		if(!isset($_POST['MessageEnvoye']))
		{
			echo "<script language=\"JavaScript\">
			alert(\"modification impossible : Aucun message selectionné !\")
			document.location.href=\"InterfaceMessage.php\"
			</script>";	
			exit();
		}
		else if ($_POST['EcrireMessage'] == null){
			echo "<script language=\"JavaScript\">
			alert(\"modification impossible : Aucun message ecrit\")
			document.location.href=\"InterfaceMessage.php\"
			</script>";	
			exit();
		}
		else 
		{
			foreach($_POST['MessageEnvoye'] as $valeur)
			{

				Message::ModifierMessage($valeur, $_POST['EcrireMessage'], date("Y-m-d H:i"), $_SESSION['idUtilisateur']);

			}
		}	
	}

	// S'abonner a un utilisateur
	if(isset($_POST['Suivre']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{
		if(!isset($_POST['AfficherUtilisateurs']))
		{
			echo "<script language=\"JavaScript\">
			alert(\"Abonnement impossible : Aucun utilisateur selectionné !\")
			document.location.href=\"InterfaceMessage.php\"
			</script>";	
			exit();
		}
		else 
		{
			// $_POST['AfficherUtilisateurs'] as $valeur;
			foreach($_POST['AfficherUtilisateurs'] as $valeur)
			{			
				Message::SAbonnerAUnUtilisateur($valeur, $_SESSION['idUtilisateur']);		
			}
		}	
	}

	// Se desabonner a un utilisateur
	if(isset($_POST['Desabonner']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{
		if(!isset($_POST['AfficherUtilisateursSuivi']))
		{
			echo "<script language=\"JavaScript\">
			alert(\"Desabonnement impossible : Aucun utilisateur selectionné !\")
			document.location.href=\"InterfaceMessage.php\"
			</script>";	
			exit();
		}
		else 
		{
			foreach($_POST['AfficherUtilisateursSuivi'] as $valeur)
			{			
				Message::DesabonnerAUnUtilisateur($valeur, $_SESSION['idUtilisateur']);		
			}
		}	
	}	

	// Supprimer compte utilisateur
	if(isset($_POST['SupprimerCompte']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
	{
		if(!isset($_SESSION['idUtilisateur']))
		{
			echo "<script language=\"JavaScript\">
			alert(\"Suppression impossible : Aucun utilisateur selectionné !\")
			document.location.href=\"InterfaceMessage.php\"
			</script>";	
			exit();
		}
		else 
		{		

				Utilisateur::SupprimerUtilisateur($_SESSION['idUtilisateur']);
		
		}		
	}	
?>


<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="favicon.ico" />
        <link rel="stylesheet" href="Style.css" />
		<meta name="author" content="David GUERRY"/>
		<meta name="keywords" content="interfaceMessage"/>
        <title>MiniTwitter</title>
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>-->

    </head>


	<body>
	<form method="post" action="">
		<header>
			<table>
				<tr>
					<td>
						<strong>Nom :</strong> 
							<?php echo $_SESSION['Nom']; ?>
					</td>
				</tr>	
				<tr>
					<td>
						<strong>Prenom :</strong> 
						<?php echo $_SESSION['Prenom']; ?>
					</td>
					<td>
						<input class="" type="submit" name="Desabonner" value="Désabonner" />
					</td>
					<td>
						<input class="" type="submit" name="Suivre" value="Suivre" />
					</td>
					<td>
						<!-- <input class="" type="button" onclick='document.location.reload(false)' value="Mettre à jour"/>  -->
						<button type="submit" onclick='document.location.reload(false)'><img src=""></button>
						<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
					</td>
					<td>
					 	<input class="" type="text" id="abonne" name="abonne"/>
					<td>
					<td>
					 	<input class="" type="submit" id="SupprimerCompte" name="SupprimerCompte" value="Suppimer son compte" />
					<td>
						<!-- <input class="" type="submit" name="Deconnexion" value="Deconnexion"/> -->
						<button type="submit" name="Deconnexion" ><img src="bouton_deconnexion.png"></button>
					</td>
				</tr>	
			</table>	
		</header>

		
	<div>		
		<table class="MessageEnvoye">
			<tr>
				<td>Messages envoyé :</td>
			</tr>
			<tr>	
				<td>
					<select size='12' style="width:400px" name='MessageEnvoye[]' id="MessageEnvoye" >
					<?php

						// Recupere les messages selon l'idUtilisateur
						$Reponse = $BaseDeDonnees->prepare('SELECT idMessage, Messages, DateCreation FROM message WHERE idUtilisateur = :idUtilisateur ORDER BY DateCreation DESC');
						
						$ResultatRequete = $Reponse->execute(array(
						':idUtilisateur' => $_SESSION['idUtilisateur']));

						// Si pas de message trouvé ...
						if($ResultatRequete == false)
						{
							echo 'Pas de message trouvé !';
							exit();
						}
						else
						{
							// Recupere les données	
							while($donnees = $Reponse->fetch())
							{
								$DateCreation = $donnees['DateCreation'];
								$DateCreationFormate = date("d/m/Y H:i", strtotime(str_replace ( "-" , "/" ,$DateCreation)));
							?>
								<option disabled="true" class="Entete"><?php echo "Publié le ".$DateCreationFormate." :"?></option>
								<option value="<?php echo $donnees['idMessage']; ?>" style="white-space: normal"><?php echo str_replace("<br /> ", "\\n", $donnees['Messages']);  ?></option>
								<option disabled="true"></option>
							<?php		
							}
						}
					?>
				</td>
			</tr>
			<tr>
				<td>Ecrire un message :</td>
			</tr>
			<tr>	
				<td>
					<TEXTAREA name="EcrireMessage" wrap="on" rows=4 cols=40 maxlength="140" placeholder="Votre message ici" style="resize:none;" spellcheck style="width:350px;height:80px" onkeydown="return (this.value.length<=140);" onkeyup="this.value=this.value.substr(0,140);nbmax.innerHTML=(140-this.value.length)+' caractères restants'"></textarea>
					<div id="nbmax">140 caractères restants</div>
				</td>
			</tr>
			<tr>
				<td>
					<input class="bouton" type="submit" name="Envoyer" value="Envoyer" />
					<input class="bouton" type="submit" name="Modifier" value="Modifier" />
					<input class="bouton" type="submit" name="Supprimer" value="Supprimer" />
				</td>
			</tr>
			<p class='MessageErreur'><?php echo $ErreurConnexion;?></p>
		</table>
		
		<table class="MessageAbonne">
			<tr>
				<td>Messages des abonnées :</td>
			</tr>
			<tr>	
				<td>
					<select class="ZoneMessage" size='8' style="width:400px" name="MessageAbonne" id="MessageAbonne">
					<?php
						// Recupere les messages selon l'idUtilisateur
						$Reponse = $BaseDeDonnees->prepare('SELECT M.idMessage, M.Messages, M.DateCreation, U.Login FROM message M, utilisateur U 
															WHERE U.idUtilisateur IN (SELECT idUtilisateurSuivi FROM abonne WHERE idUtilisateur = :idUtilisateur) 
															AND M.idUtilisateur IN (SELECT idUtilisateurSuivi FROM abonne WHERE idUtilisateur = :idUtilisateur)
															AND U.idUtilisateur = M.idUtilisateur
															ORDER BY DateCreation DESC');
						
						$ResultatRequete = $Reponse->execute(array(
						':idUtilisateur' => $_SESSION['idUtilisateur']));
						
						// Si pas de message trouvé ...
						if($ResultatRequete == false)
						{
							echo 'Pas de message trouvé !';
							exit();
						}
						else
						{
							// Recupere les données	
							while($donnees = $Reponse->fetch())
							{
							$DateCreation = $donnees['DateCreation'];
							$DateCreationFormate = date("d/m/Y H:i", strtotime(str_replace ( "-" , "/" ,$DateCreation)));
					?>
								<option disabled="true" style="color: blue"><?php echo $donnees['Login']." à publié le ".$DateCreationFormate." :" ?></option>
								<option value="<?php echo $donnees['idMessage']; ?>" style="white-space: normal"><?php echo htmlspecialchars($donnees['Messages']); ?></option>
								<option disabled="true"></option>
					<?php		
							}
						}
					?>	
				</td>
			</tr>
			<p class='MessageErreur'><?php echo $ErreurConnexion;?></p>
		</table>

		<table class="UtilisateurASuivre">
			<tr>
				<td>Utilisateurs :</td>
			</tr>
			<tr>	
				<td>
					<select size='4' style="width:120px" name='AfficherUtilisateurs[]'>
						<?php
							// Recupere les tous les utilisateurs
							$Reponse = $BaseDeDonnees->prepare('SELECT idUtilisateur, Login FROM utilisateur 
																WHERE idUtilisateur NOT IN (SELECT idUtilisateurSuivi FROM abonne WHERE idUtilisateur = :idUtilisateur)');
																
							$ResultatRequete = $Reponse->execute(array(
							':idUtilisateur' => $_SESSION['idUtilisateur']));

							// Si pas d'utilisateur trouvé ...
							if($ResultatRequete == false)
							{
								echo 'Pas de utilisateur d\'enregistré !';
								exit();
							}
							else
							{
								// Recupere les données	
								while($donnees = $Reponse->fetch())
								{
									switch($donnees['idUtilisateur']){
										case $_SESSION['idUtilisateur']:
								        	break 1;
										default:
								?>
										<option value="<?php echo $donnees['idUtilisateur']; ?>" style="color: #9900FF"> <?php echo $donnees['Login']; ?></option>
											
								<?php	
									}		
								}
							}
						?>
				</td>
			</tr>
			<p class='MessageErreur'><?php echo $ErreurConnexion;?></p>
		</table>

		<table class="UtilisateurSuivi">
			<tr>
				<td>Utilisateurs suivi:</td>
			</tr>
			<tr>	
				<td>
					<select size='4' style="width:120px" name='AfficherUtilisateursSuivi[]'>
						<?php
							// Recupere les tous les utilisateurs
							$Reponse = $BaseDeDonnees->prepare('SELECT DISTINCT U.idUtilisateur, U.Login FROM utilisateur U, abonne A 
																WHERE U.idUtilisateur IN (SELECT idUtilisateurSuivi FROM abonne WHERE idUtilisateur = :idUtilisateur)');
							
							$ResultatRequete = $Reponse->execute(array(
							':idUtilisateur' => $_SESSION['idUtilisateur']));

							// Si pas d'utilisateur trouvé ...
							if($ResultatRequete == false)
							{
								echo 'Pas de utilisateur d\'enregistré !';
								exit();
							}
							else
							{
								// Recupere les données	
								while($donnees = $Reponse->fetch())
								{
								?>
									<option value="<?php echo $donnees['idUtilisateur']; ?>" style="color: green"> <?php echo $donnees['Login']; ?></option>	
								<?php	
											
								}
							}
						?>
				</td>
			</tr>
			<p class='MessageErreur'><?php echo $ErreurConnexion;?></p>
		</table>
	</div>
</form>	

<!--<script type="text/javascript">
	$(document).ready(function() {
		    $('#abonne').autocomplete({
		        serviceUrl: 'abonne.php',
		        dataType: 'json'
		       
		    });
		});
	</script>
	-->

	    <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" src="jquery.autocomplete.min.js"></script>

		<script type="text/javascript">
	 			console.log("test");

				$(document).ready(function() 
				{
				    $('#abonne').autocomplete({serviceUrl: 'abonne.php', dataType: 'json'}); 
				    console.log("je suis entre 1.5");
				});
				console.log("je suis entre 2");
			</script>-->
			
    </body>
</html>