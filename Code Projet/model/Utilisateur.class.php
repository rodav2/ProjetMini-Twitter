<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<?PHP
class Utilisateur{
	
	private $idUtilisateur;
	private $Nom;
	private $Prenom;
	private $Login;
	private $Sexe;

	/**
	 * [__construct constructeur]
	 * @param [int] $idUtilisateur [id de l'utilisateur connecté]
	 */
	function __construct($idUtilisateur){

		// Connexion à la base de donnees
		$BaseDeDonnees = Utilitaire::Connexion();

		// Requete permettant de recuperer toutes les infos sur l'utilisateur connecté
		$Requete = $BaseDeDonnees->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = :idUtilisateur ");
					
		$donnees = $Requete->execute(array(
			'idUtilisateur' => $idUtilisateur,
			));

		 $donnees = $Requete->fetch();

		if($donnees == 0)
		{
			// Message d'erreur
			$ErreurConnexion = 'Erreur lors de la récupèration les donnees <br/>';
		}
		else
		{	
			$this->Login = $donnees['Login'];
			$this->Nom = $donnees['Nom'];
			$this->Prenom = $donnees['Prenom'];
			$this->idUtilisateur = $donnees['idUtilisateur'];
			$this->Sexe = $donnees['Sexe'];		
		}
	}

	/**
	 * [getidUtilisateur]
	 * @return [int] [id de l'utilisateur connecté]
	 */
	public function getidUtilisateur(){
		return $this->idUtilisateur;
	}

	/**
	 * [getNom]
	 * @return [varchar] [nom de l'utilisateur connecté]
	 */
	public function getNom(){
		return $this->Nom;
	}

	/**
	 * [getPrenom]
	 * @return [varchar] [prenom de l'utilisateur connecté]
	 */
	public function getPrenom(){
		return $this->Prenom;
	}	

	/**
	 * [getLogin]
	 * @return [varchar] [login de l'utilisateur connecté]
	 */
	public function getLogin(){
		return $this->Login;
	}	

	/**
	 * [getSexe]
	 * @return [bool] [sexe de l'utilisateur connecté]
	 */
	public function getSexe(){
		return $this->Sexe;
	}	

	/**
	 * [Inscription d'un nouvel utilisateur]
	 * @param [varchar] $Login  [login de l'utilisateur à inscrire]
	 * @param [varchar] $MDP    [mot de passe de l'utilisateur à inscrire]
	 * @param [varchar] $Nom    [nom de l'utilisateur à inscrire]
	 * @param [varchar] $Prenom [prenom de l'utilisateur à inscrire]
	 * @param [bool] $Sexe      [sexe de l'utilisateur à inscrire]
	 */
	public function InscriptionUtilisateur($Login, $MDP, $Nom, $Prenom, $Sexe){

		// Connexion à la base de donnees
		$BaseDeDonnees = Utilitaire::Connexion();

		// Requête de création d'un nouvel utilisateur
        $Requete = $BaseDeDonnees->prepare("INSERT INTO utilisateur(Login, Password, Nom, Prenom, Sexe)
                        					VALUES (:Identifiant, :MotDePasse, :Nom, :Prenom, :Sexe )");
                        
        return $ResultatInsertion = $Requete->execute(array(
            'Identifiant' => $Login,
            'MotDePasse' => $MDP,
            'Nom' => $Nom,
            'Prenom' => $Prenom,
            'Sexe' => $Sexe,));
	}

	/**
	 * [Connexion d'un Utilisateur]
	 * @param [varchar] $Login [login saisie par l'utilisateur]
	 * @param [varchar] $MDP   [mot de passe saisie par l'utilisateur]
	 */
	public function ConnexionUtilisateur($Login, $MDP){

		// Connexion à la base de donnees
		$BaseDeDonnees = Utilitaire::Connexion();

		// Requete qui permet à un utilisateur de se connecter 
	    $Requete = $BaseDeDonnees->prepare("SELECT idUtilisateur FROM utilisateur WHERE Login = :Identifiant AND Password = :MotDePasse");
	                    
	    $Requete->execute(array(
	        'Identifiant' => $Login,
	        'MotDePasse' => $MDP));

	    $donnees = $Requete->fetch();

		// Termine le traitement de la requête
		$Requete->closeCursor(); 

	    if($donnees['idUtilisateur'] != 0)
	    {
	    	$UtilisateurCourant = new Utilisateur($donnees['idUtilisateur']);

	    	$_SESSION['Login'] = $UtilisateurCourant->getLogin();
			$_SESSION['Nom'] = $UtilisateurCourant->getNom();
			$_SESSION['Prenom'] = $UtilisateurCourant->getPrenom();
			$_SESSION['idUtilisateur'] = $UtilisateurCourant->getidUtilisateur();
			$_SESSION['Sexe'] = $UtilisateurCourant->getSexe();

			// Redirection vers la page des messages
			header('Location:index.php?page=InterfaceMessage');
		
	    }else{

	    	// Message d'erreur
			$ErreurConnexion = 'Identifiant incorrect : Veuillez vérifier vos identifiants <br/>';

	    	echo "<script language=\"JavaScript\">
			alert(\"Connexion impossible Verifier vos identifiant ou inscrivez-vous !\")
			document.location.href=\"index.php\"
			</script>";			
	    }
	}

	/**
	 * [Supprimer d'un utilisateur]
	 * @param [int] $idUtilisateur [id de l'utilisateur connecté]
	 */
	public function SupprimerUtilisateur($idUtilisateur){

		// Connexion à la base de donnees
        $BaseDeDonnees = Utilitaire::Connexion();
        
        // Supprimer un utilisateur selon son idUtilisateur
        $Reponse = $BaseDeDonnees->prepare('DELETE FROM Utilisateur WHERE idUtilisateur = :idUtilisateur');

        $ResultatRequete = $Reponse->execute(array(
        ':idUtilisateur' => $idUtilisateur));

	}

	/**
	 * [Recuperer les utilisateurs non suivi]
	 * @param [int] $idUtilisateur [id de l'utilisateur connecté]
	 */
	public function RecupererUtilisateursNonSuivi($idUtilisateur){

		// Connexion à la base de donnees
		$BaseDeDonnees = Utilitaire::Connexion();

		// Recupere tous les utilisateurs non suivi
		$Reponse = $BaseDeDonnees->prepare('SELECT idUtilisateur, Login FROM utilisateur 
											WHERE idUtilisateur NOT IN (SELECT idUtilisateurSuivi FROM abonne WHERE idUtilisateur = :idUtilisateur)');
											
		$Reponse->execute(array(
		':idUtilisateur' => $idUtilisateur));

		return $Reponse;
	}

	/**
	 * [Utilisateurs suivi]
	 * @param [int] $idUtilisateur [id de l'utilisateur connecté]
	 */
	public function UtilisateursSuivi($idUtilisateur){

		// Connexion à la base de donnees
		$BaseDeDonnees = Utilitaire::Connexion();

		// Recupere tous les utilisateurs suivi
		$Reponse = $BaseDeDonnees->prepare('SELECT DISTINCT U.idUtilisateur, U.Login FROM utilisateur U, abonne A 
											WHERE U.idUtilisateur IN (SELECT idUtilisateurSuivi FROM abonne WHERE idUtilisateur = :idUtilisateur)');

		$Reponse->execute(array(
		':idUtilisateur' => $_SESSION['idUtilisateur']));

		return $Reponse;
	}

	/**
	 * [Verifier si le login saisie par l'utilisateur n'existe pas deja]
	 * @param [varchar] $Login [login saisie par l'utilisateur]
	 */
	public function VerifierLogin($Login){

		// Connexion à la base de donnees
		$BaseDeDonnees = Utilitaire::Connexion();

		// Requete de recuperation des logins utilisateurs
		$Reponse = $BaseDeDonnees->prepare('SELECT Login FROM utilisateur');

		$Reponse->execute(array());
		
		$donnees = $Reponse->fetchAll();

		for ($i=0; $i < sizeof($donnees); $i++) { 

			if($Login == $donnees[$i]['Login'])
			{
				$Valeur = true;
				exit();
			}else{
		
				$Valeur = false;	
			}
		}
		return $Valeur;
	}
}
