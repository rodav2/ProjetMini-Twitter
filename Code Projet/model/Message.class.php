<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<?PHP
abstract class Message{

	/**
	 * [Afficher les messages de utilisateur connecté]
	 * @param [int] $idUtilisateur [id de l'utilisateur connecté]
	 */
	public function AfficherMessageUtilisateur($idUtilisateur){

        // Connexion à la base de donnees
        $BaseDeDonnees = Utilitaire::Connexion();
        
        // Recupere les messages selon l'idUtilisateur
        $Reponse = $BaseDeDonnees->prepare('SELECT idMessage, Messages, DateCreation FROM message WHERE idUtilisateur = :idUtilisateur ORDER BY DateCreation DESC');

        $ResultatRequete = $Reponse->execute(array(
        ':idUtilisateur' => $_SESSION['idUtilisateur']));

        return $donnees = $Reponse->fetchAll();
	}

	/**
	 * [Afficher les messages des abonnes]
	 * @param [int] $idUtilisateur [id de l'utilisateur connecté]
	 */
	public function AfficherMessageAbonne($idUtilisateur){

        // Connexion à la base de donnees
        $BaseDeDonnees = Utilitaire::Connexion();

        // Recupere les messages des abonnes selon l'idUtilisateur connecté
        $Reponse = $BaseDeDonnees->prepare('SELECT M.idMessage, M.Messages, M.DateCreation, U.Login FROM message M, utilisateur U 
                                            WHERE U.idUtilisateur IN (SELECT idUtilisateurSuivi FROM abonne WHERE idUtilisateur = :idUtilisateur) 
                                            AND M.idUtilisateur IN (SELECT idUtilisateurSuivi FROM abonne WHERE idUtilisateur = :idUtilisateur)
                                            AND U.idUtilisateur = M.idUtilisateur
                                            ORDER BY DateCreation DESC');
        
        $ResultatRequete = $Reponse->execute(array(
        ':idUtilisateur' => $idUtilisateur));

        return $donnees = $Reponse->fetchAll();

	}

	/**
	 * [Creation d'un message]
	 * @param [varchar] $Messages  [Message a enregistrer]
	 * @param [date] $DateCourante [date de création du message]
	 * @param [int] $idUtilisateur [id de l'utilisateur connecté]
	 */
	public function CreationMessage($Messages, $DateCourante, $idUtilisateur){

		// Connexion à la base de donnees
		$BaseDeDonnees = Utilitaire::Connexion();

		// Requete d'insertion de nouveau message
		$requete = $BaseDeDonnees->prepare("INSERT INTO message(Messages, DateCreation, idUtilisateur)
						VALUES (:Messages, :DateCreation, :idUtilisateur)");
		
		return $ResultatInsertion = $requete->execute(array(
			'Messages' => $Messages,
			'DateCreation' => $DateCourante,
			'idUtilisateur' => $idUtilisateur,
			));
	}

	/**
	 * [Modifier un message]
	 * @param [int] $valeur        [id du message à modifier]
	 * @param [varchar] $Messages  [Message a enregistrer]
	 * @param [date] $DateCourante [date de création du message]
	 * @param [int] $idUtilisateur [id de l'utilisateur connecté]
	 */
	public function ModifierMessage($valeur, $Message, $DateCourante, $idUtilisateur){

		// Connexion à la base de donnees
		$BaseDeDonnees = Utilitaire::Connexion();
		
		// Requete pour modifier le message par rapport à son id
		$requete = $BaseDeDonnees->prepare("UPDATE message SET Messages = :Messages, DateCreation = :DateCourante, idUtilisateur = :idUtilisateur
		WHERE idMessage = :idMessage");

		$requete->execute(array(
			'idMessage' => $valeur,
			'Messages' => $Message,
			'DateCourante' => $DateCourante,
			'idUtilisateur' => $idUtilisateur,
			));
	}

	/**
	 * [Suppression d'un message]
	 * @param [int] $valeur [id du message à modifier]
	 */
	public function SuppressionMessage($valeur){
        // Connexion à la base de donnees
		$BaseDeDonnees = Utilitaire::Connexion();

		// Requete pour supprimer un message par rapport à son id
		$requete = $BaseDeDonnees->prepare("DELETE FROM message WHERE idMessage = :idMessage");

		$requete->execute(array(
			'idMessage' => $valeur));
	}
}    
