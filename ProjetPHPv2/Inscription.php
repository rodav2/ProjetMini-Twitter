<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<!-- remettre les informations deja saisie lors d'une erreur-->

<?php


// inclusion des classes
include_once "Utilisateur.class.php";
include_once "ConnexionBaseDeDonnees.php";
include_once "Utilitaire.class.php";

$ConnexionBDD = new Utilitaire;
$ConnexionBDD->Connexion();

// Initialisation
$ErreurConnexion = '';

// Savoir si le bouton valider est cliqué et savoir si formulaire a etait envoyé
if(isset($_POST['Valider']) && (strtolower($_SERVER['REQUEST_METHOD']) == 'post'))
{

    // Si tout va bien, on peut continuer
    $Login = $_POST['Identifiant'];
    $MDP = sha1($_POST['MotDePasse']);
    $Nom = $_POST['Nom'];
    $Prenom = $_POST['Prenom'];
    $Confirmation = sha1($_POST['Confirmation']);
    
    // Vérification des caractéres saisie dans la zone 'identifiant'
    if(!preg_match("#^[a-z0-9]{1,20}$#i",$Login)) /* #^ = debut, [a-z0-9] = lettres et chiffres autorisées, {1,20} = minim: 1 caract, maxi: 20 caract*/
    {
        echo "<script language=\"JavaScript\">
        alert(\"Caractére(s) incorrect ou zone de saisie vide !\")
        document.location.href=\"Inscription.php\"
        </script>"; 
        exit();
    }

    // Test des champs vide
    if($Nom == '' || $Prenom == '' || $Login == '' || $MDP == '')
    {
            echo "<script language=\"JavaScript\">
            alert(\"L'un des champs est vide !\")
            document.location.href=\"Inscription.php\"
            </script>";
            exit();
    }
    else if($MDP != $Confirmation){
            echo "<script language=\"JavaScript\">
            alert(\"Mot de passe différent\")
            document.location.href=\"Inscription.php\"
            </script>";
            exit();
    }
    else
    {
        
        $NouvelUtilisateur = new Utilisateur;
        $NouvelUtilisateur->InscriptionUtilisateur($Login, $MDP, $Nom, $Prenom);

    }       

// Termine le traitement de la requête
$reponse->closeCursor(); 
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
        <div class="inscription">    
        <h1 style="text-align: center;">Inscription</h1>   
        <p>Veuillez saisir toutes vos données personnel pour finaliser l'inscription</p>
        <form method="post" action="">  
            <table>
                <tr>
                    <td>Nom :</td>
                    <td><input type="text" name="Nom" size="20" /></td>
                </tr>
                <tr>
                    <td>Prenom :</td>
                    <td><input type="text" name="Prenom" size="20" /></td>
                </tr>
                <tr>
                    <td>Identifiant :</td>
                    <td><input type="text" name="Identifiant" size="20" /></td>
                </tr>
                <tr>
                    <td>Mot de passe :</td>
                    <td><input type="password" name="MotDePasse" size="20" /></td>
                </tr>
                <tr>
                    <td>Confirmation :</td>
                    <td><input type="password" name="Confirmation" size="20" /></td>
                </tr>
                <tr>
                    <td><br/><br/><input class="bouton" type="submit"  name="Valider" />
                    <input class="bouton" type="button" name="Retour" value="Retour" onclick="self.location.href='Index.php'" style="background-color:#3cb371" style="color:white; font-weight:bold"onclick /></td>
                </tr>
                <p class='MessageErreur'><?php echo $ErreurConnexion; ?></p>
            </table>
        </form>
    </div>  
    </body>
</html>