<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<!-- **************************************************************************************************************************************** -->
<!-- ************************************************************** MENU D'ENTÊTE *********************************************************** -->
<!-- **************************************************************************************************************************************** -->
<form method="post" action="">
	<header class="container">
		<table>
			<tr>
				<td style="font-size: 20px">
					<strong>Nom :</strong> 
					<span ><?php echo $_SESSION['Nom']; ?></span>	
				</td>
			</tr>	
			<tr>
				<td style="font-size: 20px">
					<strong>Prenom :</strong> 
					<?php echo $_SESSION['Prenom']; ?>
				</td>
				<td>
					<input class="boutonDesabonner" type="submit" name="Desabonner" value="Désabonner">
				</td>
				<td>
					<input class="boutonSuivre" type="submit" name="Suivre" value="Suivre">
				</td>
				<td>
					<img onclick='document.location.reload(false)'class="rafraichir" src="http://png-5.findicons.com/files/icons/2152/snowish/128/gtk_refresh.png" alt="Rafraichir">
					<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
				</td>
				<td>
					<input class="boutonSupprimerCompte" type="submit" id="SupprimerCompte" name="SupprimerCompte" value="Suppimer son compte">
				</td>
				<td class="boutonDeconnexion">
					<button type="submit" name="Deconnexion" ><img src="image/bouton_deconnexion.png"></button>
				</td>
			</tr>	
		</table>	
	</header>
<!-- **************************************************************************************************************************************** -->
<!-- ************************************************************** ICONES DE L'UTILISATEUR **************************************************** -->
<!-- **************************************************************************************************************************************** -->
	<div>
	 	<?php echo $IconeSexe; ?>
	</div>	

<!-- **************************************************************************************************************************************** -->
<!-- ************************************************************** MESSAGES UTILISATEUR **************************************************** -->
<!-- **************************************************************************************************************************************** -->		
	<div>		
		<table class="MessageEnvoye container">
			<tr>
				<td class="titre">Messages envoyé :</td>
			</tr>
			<tr>	
				<td>
					<select size='12px' style="width:500px; font-size: 12px;" name='MessageEnvoye[]' id="MessageEnvoye" >
					<?php
						// Si pas de message trouvé ...
						if(sizeof($MessagesUtilisateur) == 0)
						{
							echo 'Pas de message trouvé !';
						?>	
							<option disabled="true">Aucun message enregistré...</option>
						<?php	
						}
						else
						{
							// Recupere les données	
							foreach ($MessagesUtilisateur as $Message) 
							{
								$DateCreation = $Message['DateCreation'];
								$DateCreationFormate = date("d/m/Y H:i", strtotime(str_replace ( "-" , "/" ,$DateCreation)));
							?>
								<option disabled="true" class="Entete"><?php echo "Publié le ".$DateCreationFormate." :"?></option>
								<option value="<?php echo $Message['idMessage']; ?>" style="white-space: normal"><?php echo str_replace("<br />", " ", htmlspecialchars($Message['Messages']));  ?></option>
								<option disabled="true"></option>
							<?php		
							}
						}
					?>
					</select>
				</td>
			</tr>

<!-- **************************************************************************************************************************************** -->
<!-- ************************************************************** POSTER UN MESSAGE  ****************************************************** -->
<!-- **************************************************************************************************************************************** -->			
			<tr>
				<td class="titre">Ecrire un message :</td>
			</tr>
			<tr>	
				<td>
					<TEXTAREA name="EcrireMessage" wrap="on" rows=4 cols=40 maxlength="140" placeholder="Votre message ici" style="resize:none; width:350px;height:80px" spellcheck onkeydown="return (this.value.length<=140);" onkeyup="this.value=this.value.substr(0,140);nbmax.innerHTML=(140-this.value.length)+' caractères restants'"></textarea>
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

<!-- **************************************************************************************************************************************** -->
<!-- ************************************************************** MESSAGES DES ABONNES **************************************************** -->
<!-- **************************************************************************************************************************************** -->

		<table class="MessageAbonne container">
			<tr>
				<td class="titre">Messages des abonnées :</td>
			</tr>
			<tr>	
				<td>
					<select class="ZoneMessage" size='8' style="width:500px;" name="MessageAbonne" id="MessageAbonne">
					<?php
						// Si pas de message trouvé ...
						if(sizeof($Messages) == 0)
						{
							echo 'Pas de message trouvé !';
						?>	
							<option disabled="true">Pas de message trouvé !...</option>
						<?php	
						}
						else
						{
							// Recupere les données	
							foreach ($Messages as $Message) 
							{
								$DateCreation = $Message['DateCreation'];
								$DateCreationFormate = date("d/m/Y H:i", strtotime(str_replace ( "-" , "/" ,$DateCreation)));
					?>
								<option disabled="true" style="color: blue"><?php echo $Message['Login']." à publié le ".$DateCreationFormate." :" ?></option>
								<option value="<?php echo $Message['idMessage']; ?>" style="white-space: normal;"><?php echo htmlspecialchars($Message['Messages']); ?></option>
								<option disabled="true"></option>
					<?php		
							}
						}
					?>	
					</select>
				</td>
			</tr>
			<p class='MessageErreur'><?php echo $ErreurConnexion;?></p>
		</table>

<!-- **************************************************************************************************************************************** -->
<!-- ************************************************************** UTILISATEURS ************************************************************ -->
<!-- **************************************************************************************************************************************** -->

		<table class="UtilisateurASuivre container">
			<tr>
				<td class="titre">Utilisateurs :</td>
			</tr>
			<tr>	
				<td>
					<select class="ZoneMessage" size='12' style="width:200px; font-size: 14px;" name='AfficherUtilisateurs[]'>
						<?php
						
							// Si pas d'utilisateur trouvé ...
							if($UtilisateurASuivre == false)
							{
								echo 'Pas de utilisateur d\'enregistré !';
							}
							else
							{
								// Recupere les données	
								while($donnees = $UtilisateurASuivre->fetch())
								{
									switch($donnees['idUtilisateur']){
										case $_SESSION['idUtilisateur']:
								        	break 1;
										default:
								?>
										<option value="<?php echo $donnees['idUtilisateur']; ?>" style="color: #9900FF;"><?php echo $donnees['Login']; ?></option>	
								<?php	
									}		
								}
							}
						?>
					</select>	
				</td>
			</tr>
			<p class='MessageErreur'><?php echo $ErreurConnexion;?></p>
		</table>

<!-- **************************************************************************************************************************************** -->
<!-- ************************************************************** UTILISATEURS SUIVI ****************************************************** -->
<!-- **************************************************************************************************************************************** -->

		<table class="UtilisateurSuivi container">
			<tr>
				<td class="titre">Utilisateurs suivi:</td>
			</tr>
			<tr>	
				<td>
					<select class="ZoneMessage" size='12' style="width:200px; font-size: 14px;" name='AfficherUtilisateursSuivi[]'>
						<?php
							// Si pas d'utilisateur trouvé ...
							if($UtilisateurSuivi == false)
							{
								echo "Pas de utilisateur d'enregistré !";
							}
							else
							{
								// Recupere les données	
								while($donnees = $UtilisateurSuivi->fetch())
								{
								?>
									<option value="<?php echo $donnees['idUtilisateur']; ?>" style="color: green"> <?php echo $donnees['Login']; ?></option>	
								<?php				
								}
							}
						?>
					</select>	
				</td>
			</tr>
			<p class='MessageErreur'><?php echo $ErreurConnexion;?></p>
		</table>
	</div>
</form>	

