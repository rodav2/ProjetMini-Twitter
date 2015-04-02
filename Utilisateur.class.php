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


	fonction __construct($idUtilisateur){

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
	}		

	public function CreerUtilisateur($ChampNom, $ChampPrenom, $ChampLogin, $ChampPassword){

	}

	public function SupprimerUtilisateur($ChampNom, $ChampPrenom, $ChampLogin, $ChampPassword){

	}

	public function ComparerPassword($Champ1, $Champ2){

	}

	public function VerifierPassword($Champ1){
		$Champ1 == $Password ;
	}










}
