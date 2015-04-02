<!--
AUTEUR: Guerry David
DATE DE DEBUT: 13-12-2014
PROJET LicencePro twitter-->

<div class="inscription">    
    <h1 style="text-align: center;">Inscription</h1>   
    <p>Veuillez saisir toutes vos données personnel pour finaliser l'inscription</p>
    <form method="post" action="">  
        <table>
            <tr>
                <td>Nom :</td>
                <td><input type="text" name="NomInscription" size="20" required="required"/></td>
            </tr>
            <tr>
                <td>Prenom :</td>
                <td><input type="text" name="PrenomInscription" size="20" required="required"/></td>
            </tr>
            <tr>
                <td>Identifiant :</td>
                <td><input type="text" name="IdentifiantInscription" size="20" required="required"/></td>
            </tr>
            <tr>
                <td>Mot de passe :</td>
                <td><input type="password" name="MotDePasseInscription" size="20" required="required"/></td>
            </tr>
            <tr>
                <td>Confirmation :</td>
                <td><input type="password" name="ConfirmationInscription" size="20" required="required"/></td>
            </tr>
            <tr>
                <td>Sexe :</td>
                <td>
                    <select name="Sexe">
                      <option value="SexeHomme">Homme</option>
                      <option value="SexeFemme">Femme</option>
                   </select>
                </td>
            </tr>
            <tr>
                <td><br/><br/><input class="bouton" type="submit"  name="ValiderInscription" />
                <input class="bouton" type="button" name="Retour" value="Retour" onclick="self.location.href='index.php'" style="background-color:#3cb371" style="color:white; font-weight:bold"onclick /></td>
            </tr>
            <p class='MessageErreur'><?php echo $ErreurConnexion; ?></p>
        </table>
    </form>
</div>  
