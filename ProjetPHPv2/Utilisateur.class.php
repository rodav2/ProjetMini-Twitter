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
	private $Password;

	/*fonction __construct($idUtilisateur){

	}

	public fonction getidUtilisateur(){
		return this->idUtilisateur;
	}

	public fonction getNom(){
		return this->Nom;
	}

	public fonction getPrenom(){
		return this->Prenom;
	}	

	public fonction getLogin(){
		return this->Login;
	}	

	public fonction getPassword(){
		return this->Password;
	}*/		

	public function InscriptionUtilisateur($Login, $MDP, $Nom, $Prenom){

		$BaseDeDonnees = Utilitaire::Connexion();

		// Requête de création d'un nouvel utilisateur
        $Requete = $BaseDeDonnees->prepare("INSERT INTO utilisateur(Login, Password, Nom, Prenom)
                        					VALUES (:Identifiant, :MotDePasse, :Nom, :Prenom)");
                        
        $ResultatInsertion = $Requete->execute(array(
            'Identifiant' => $Login,
            'MotDePasse' => $MDP,
            'Nom' => $Nom,
            'Prenom' => $Prenom));
        
        // Vérification de la requête
        if($ResultatInsertion == true)  
        {   
            echo "<script language=\"JavaScript\">
            alert(\"Nouvel utilisateur enregistré !\")
            document.location.href=\"Index.php\"
            </script>"; 

        }
        else
        {
            echo "<script language=\"JavaScript\">
            alert(\"Erreur lors de l'enregistrement du nouvel utilisateur !\")
            document.location.href=\"Inscription.php\"
            </script>"; 
            exit();
        }   
	}

	/*public function SupprimerUtilisateur($ChampNom, $ChampPrenom, $ChampLogin, $ChampPassword){

	}

	public function ComparerPassword($Champ1, $Champ2){

	}

	public function VerifierPassword($Champ1){
		$Champ1 == $Password ;
	}*/



	public function ConnexionUtilisateur($Login, $MDP){

		$BaseDeDonnees = Utilitaire::Connexion();

		// On récupère tout le contenu de la table 
	    $Requete = $BaseDeDonnees->prepare("SELECT * FROM utilisateur WHERE Login = :Identifiant AND Password = :MotDePasse");
	                    
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
	}


	public function SupprimerUtilisateur($idUtilisateur){

		$BaseDeDonnees = Utilitaire::Connexion();

		$requete = $BaseDeDonnees->prepare("DELETE FROM utilisateur U, abonne A, message M WHERE A.idUtilisateur = :idUtilisateur 
													AND M.idUtilisateur = :idUtilisateur AND U.idUtilisateur = :idUtilisateur");
					
		$requete->execute(array(
			'idUtilisateur' => $idUtilisateur,
			));
			
		// detruit la session	
		session_destroy();
			
		echo "<script language=\"JavaScript\">
		alert(\"Suppression réussit !\")
		document.location.href=\"InterfaceMessage.php\"
		</script>";	
	}			
}
