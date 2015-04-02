<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<?PHP
	//include_once "Utilitaire.class.php";

class Message{

	private $idMessage;
	private $Messages;
	private $DateCreation;
	private $idUtilisateur;


	/*fonction __construct($idUtilisateur){

	}

	public fonction getidMessage(){
		return this->idMessage;
	}

	public fonction getMessages(){
		return this->Messages;
	}

	public fonction getDateCreation(){
		return this->DateCreation;
	}	

	public fonction getidUtilisateur(){
		return this->idUtilisateur;
	}

	public fonction getidUtilisateur(){
		return this->idUtilisateur;
	}*/

	public function AfficherMessage($ChampNom, $ChampPrenom, $ChampLogin, $ChampPassword){

	}

	public function AfficherMessageAbonne($ChampNom, $ChampPrenom, $ChampLogin, $ChampPassword){

	}

	public function CreationMessage($Messages, $DateCourante, $idUtilisateur){


		$BaseDeDonnees = Utilitaire::Connexion();

		// Requete d'insertion de message
		$requete = $BaseDeDonnees->prepare("INSERT INTO message(Messages, DateCreation, idUtilisateur)
						VALUES (:Messages, :DateCreation, :idUtilisateur)");
		
		$ResultatInsertion = $requete->execute(array(
			'Messages' => $Messages,
			'DateCreation' => $DateCourante,
			'idUtilisateur' => $idUtilisateur,
			));

		// Verification de la requete	
		if($ResultatInsertion == true)	
		{	
			echo "<script language=\"JavaScript\">
			alert(\"Message enregistré !\")
			document.location.href=\"InterfaceMessage.php\"
			</script>";			
		}
		else
		{
			echo "<script language=\"JavaScript\">
			alert(\"Erreur lors de l'enregistrement du message !\")
			document.location.href=\"InterfaceMessage.php\"
			</script>";	
			exit();
		}
	}

	public function ModifierMessage($valeur, $Message, $DateCourante, $idUtilisateur){

		$BaseDeDonnees = Utilitaire::Connexion();
		
		// Requete pour modifier le message par rapport a son id
		$requete = $BaseDeDonnees->prepare("UPDATE message SET Messages = :Messages, DateCreation = :DateCourante, idUtilisateur = :idUtilisateur
		WHERE idMessage = :idMessage");

		$requete->execute(array(
			'idMessage' => $valeur,
			'Messages' => $Message,
			'DateCourante' => $DateCourante,
			'idUtilisateur' => $idUtilisateur,
			));

		echo "<script language=\"JavaScript\">
		alert(\"Message(s) bien modifier !\")
		document.location.href=\"InterfaceMessage.php\"
		</script>";	
	}

	public function SuppressionMessage($valeur){

		$BaseDeDonnees = Utilitaire::Connexion();

		$requete = $BaseDeDonnees->prepare("DELETE FROM message WHERE idMessage = :idMessage");

		$requete->execute(array(
			'idMessage' => $valeur));
			
		echo "<script language=\"JavaScript\">
		alert(\"Message(s) bien supprimé !\")
		document.location.href=\"InterfaceMessage.php\"
		</script>";	
	}

	public function SAbonnerAUnUtilisateur($valeur, $idUtilisateur){

		$BaseDeDonnees = Utilitaire::Connexion();

		$requete = $BaseDeDonnees->prepare("INSERT INTO abonne VALUES (:idUtilisateur, :idUtilisateurSuivi)");

		$requete->execute(array(
			'idUtilisateur' => $idUtilisateur,
			'idUtilisateurSuivi' => $valeur));
			
		echo "<script language=\"JavaScript\">
		alert(\"Utilisateur suivi !\")
		document.location.href=\"InterfaceMessage.php\"
		</script>";	
	}

	public function DesabonnerAUnUtilisateur($valeur, $idUtilisateur){

		$BaseDeDonnees = Utilitaire::Connexion();

		$requete = $BaseDeDonnees->prepare("DELETE FROM abonne WHERE idUtilisateur = :idUtilisateur AND idUtilisateurSuivi = :idUtilisateurSuivi");
					
		$requete->execute(array(
			'idUtilisateur' => $idUtilisateur,
			'idUtilisateurSuivi' => $valeur));
			
		echo "<script language=\"JavaScript\">
		alert(\"Desabonnement réussit !\")
		document.location.href=\"InterfaceMessage.php\"
		</script>";	

	}




    /**
     * Gets the value of idMessage.
     *
     * @return mixed
     */
    public function getIdMessage()
    {
        return $this->idMessage;
    }

    /**
     * Sets the value of idMessage.
     *
     * @param mixed $idMessage the id message
     *
     * @return self
     */
    private function _setIdMessage($idMessage)
    {
        $this->idMessage = $idMessage;

        return $this;
    }

    /**
     * Gets the value of Messages.
     *
     * @return mixed
     */
    public function getMessages()
    {
        return $this->Messages;
    }

    /**
     * Sets the value of Messages.
     *
     * @param mixed $Messages the messages
     *
     * @return self
     */
    private function _setMessages($Messages)
    {
        $this->Messages = $Messages;

        return $this;
    }

    /**
     * Gets the value of DateCreation.
     *
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->DateCreation;
    }

    /**
     * Sets the value of DateCreation.
     *
     * @param mixed $DateCreation the date creation
     *
     * @return self
     */
    private function _setDateCreation($DateCreation)
    {
        $this->DateCreation = $DateCreation;

        return $this;
    }

    /**
     * Gets the value of idUtilisateur.
     *
     * @return mixed
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Sets the value of idUtilisateur.
     *
     * @param mixed $idUtilisateur the id utilisateur
     *
     * @return self
     */
    private function _setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }
}