<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<?PHP
class Utilitaire{


	public function Connexion(){

		try
		{
			// Requête permettant la connection à la base de données MySQL (nom de BDD, identifiant Mysql, MDP Mysql)
			return $BaseDeDonnees = new PDO('mysql:host=localhost;dbname=twitter', 'root', '');
		}
		catch(Exception $erreur)
		{
			// En cas d'erreur, on affiche un message
				echo 'Impossible de se connecter à la base de données<br/>';
				die('Erreur : '.$erreur->getMessage());
				exit();
		}
	}

	public function Deconnexion(){
		session_unset(); // Détruit toutes les variables d'une session
		header('Location:index.php'); // Redirection vers la page index.php
	}

	// Page d'accueil
	public function Effacer(){

	}


}
