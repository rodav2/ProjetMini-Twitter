<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<div class="connexion">
	<h1 style="text-align: center;">Connexion</h1>				
	<form method="post" action="">
		<table>
			<tr>
				<td>Identifiant :</td>
				<td><input type="text" name="Identifiant" size="20" placeholder="guerryd" required="required"/></td>
			</tr>
			<tr>
				<td>Mot de passe :</td>
				<td><input type="password" name="MotDePasse" size="20" placeholder="12345" required="required"/></td>
			</tr>
			<tr>
				<td colspan="2"><br/><br/><input class="bouton" type="submit" name="ValiderConnexion" value="Se connecter" /></td>
				<td colspan="2"><br/><br/><input class="bouton" type="submit" name="Effacer" value="Effacer" /></td>
			</tr>
			<td>
				<b><i>Vous n'avez pas de compte ?</i></b>
				<a href="index.php?page=Inscription">Enregistrez-vous maintenant</a>
			</td>
			<p class='MessageErreur'><?php echo $ErreurConnexion;?></p>
		</table>
	</form>
</div>



