<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<?php

// Connexion a la base de données
include_once "Utilitaire.class.php";
include_once "Utilisateur.class.php";

$BaseDeDonnees = Utilitaire::Connexion();

// Connexion a la base de données
// include_once "Utilitaire.class.php";
// $ConnexionBDD = new Utilitaire;
// $BaseDeDonnees = $ConnexionBDD->Connexion();

// Démarre une nouvelle session ou reprend une session existante
session_start();

// Détruit toutes les variables d'une session
session_unset();

// Initialisation
$ErreurConnexion = '';

// Savoir si le bouton valider est cliqué et savoir si formulaire a etait envoyé
if(isset($_POST['Valider']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
{
	// Si tout va bien, on peut continuer
	$Login = $_POST['Identifiant'];
	$MDP = sha1($_POST['MotDePasse']);


	Utilisateur::ConnexionUtilisateur($Login, $MDP);

                    
    $ResultatInsertion = $Requete->execute(array(
        'Identifiant' => $Login,
        'MotDePasse' => $MDP));
	
	$donnees = $Requete->fetch();

	if($donnees==0)
	{
		// Message d'erreur
		$ErreurConnexion = 'Identifiant incorrect : Veuillez vérifier vos identifiants <br/>';
	}
	else
	{	
		$_SESSION['Identifiant'] = $Login;
		$_SESSION['MotDePasse'] = $MDP;
		$_SESSION['Nom'] = $donnees['Nom'];
		$_SESSION['Prenom'] = $donnees['Prenom'];
		$_SESSION['idUtilisateur'] = $donnees['idUtilisateur'];
		
		// Redirection vers la page des messages
		header('Location:InterfaceMessage.php');
	}

// Termine le traitement de la requête
//$reponse->closeCursor(); 
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
		<meta name="keywords" content="authentification/inscription"/>
        <title>Authentification</title>
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

	<body>
	<div class="connexion">
		<h1 style="text-align: center;" >Connexion</h1>				
		<form method="post" action="">	
			<table>
				<tr>
					<td>Identifiant :</td>
					<td><input type="text" name="Identifiant" size="20" placeholder="guerryd"  /></td>
				</tr>
				<tr>
					<td>Mot de passe :</td>
					<td><input type="password" name="MotDePasse" size="20" placeholder="12345"/></td>
				</tr>
				<tr>
					<td colspan="2"><br/><br/><input class="bouton" type="submit" name="Valider" value="Se connecter" /></td>
					<td colspan="2"><br/><br/><input class="bouton" type="submit" name="Effacer" value="Effacer" /></td>
				</tr>
				<td>
					<b><i>Vous n'avez pas de compte ?</i></b>
					<a href="Inscription.php">Enregistrez-vous maintenant</a>
				</td>

				<p class='MessageErreur'><?php echo $ErreurConnexion;?></p>
			</table>
		</form>
	</div>
    </body>
</html>


