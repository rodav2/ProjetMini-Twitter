<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<?PHP
abstract class Abonne{

	/**
	 * [S'abonner a un utilisateur]
	 * @param [int] $valeur        [id de l'utilisateur à suivre]
	 * @param [int] $idUtilisateur [id de l'utilisateur connecté]
	 */
	public function SAbonnerAUnUtilisateur($valeur, $idUtilisateur){

		// Connexion a la base de donnees
		$BaseDeDonnees = Utilitaire::Connexion();

		// Requete d'insertion d'un utilisateur à suivre
		$requete = $BaseDeDonnees->prepare("INSERT INTO abonne VALUES (:idUtilisateur, :idUtilisateurSuivi)");

		$requete->execute(array(
			'idUtilisateur' => $idUtilisateur,
			'idUtilisateurSuivi' => $valeur));
	}

	/**
	 * [Se desabonner a un utilisateur]
	 * @param [int] $valeur        [id de l'utilisateur à desabonner]
	 * @param [int] $idUtilisateur [id de l'utilisateur connecté]
	 */
	public function DesabonnerAUnUtilisateur($valeur, $idUtilisateur){

		// Connexion a la base de donnees
		$BaseDeDonnees = Utilitaire::Connexion();

		// Requete de suppression d'un utilisateur suivi
		$requete = $BaseDeDonnees->prepare("DELETE FROM abonne WHERE idUtilisateur = :idUtilisateur AND idUtilisateurSuivi = :idUtilisateurSuivi");
					
		$requete->execute(array(
			'idUtilisateur' => $idUtilisateur,
			'idUtilisateurSuivi' => $valeur));
	}
}
	