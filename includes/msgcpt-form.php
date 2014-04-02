<?PHP 
include_once('../header.php');
$ParamNivAccessPage = array(1,8);
$ValidAccess = VerifAccess($ParamNivAccessPage,$_SESSION['nivadm']);
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && ($_SESSION['adm']=="OK") && ($ValidAccess == TRUE)) {    

?>
<STYLE type="text/css">
#tableDmd {display: table;}
.row {display: table-row;}
.cell {display: table-cell;}
</STYLE>
<div id="recDmdMsg"><div id="mainContainer" style="width:98%">
	<fieldset>
	Ce formulaire est destine a effectuer des demandes relatives aux comptes de messagerie :<br />
	<form action="Record.php" method="post" name="FormDmdMsg">
	<table><tr><td><b><center>Nature de la demande</center></b><fieldset class="FieldsetValidator"> 
		<table> 
			<tr>
				<td width="150"><label for="msgdmdcateg">Categorie</label></td>
				<td></td>
				<td height="20"><SELECT name="msgdmdcateg" class="subscribe-box" onChange="showCreateMsgMail(this.selectedIndex)" size="1">
				<OPTION>Choisir une option</OPTION><OPTION VALUE="CREA">Creation de compte email</OPTION><OPTION VALUE="SUPPR">Suppression de compte email</OPTION><OPTION VALUE="MOD">Modification de compte email</OPTION><OPTION VALUE="TRAV">Acces Traveler</OPTION><OPTION VALUE="CERTID">Certification et IDs</OPTION></SELECT></td>
			</tr>
			<tr style="display:none" id="divMsgModifCpt">
				<td width="150"><label for="msgdmdmodif">Modification du compte</label></td>
				<td></td>
				<td height="20"><SELECT name="msgdmdmodif" class="subscribe-box" onChange="showModifMsgCpt(this.selectedIndex)" size="1">
				<OPTION>Choisir une option</OPTION><OPTION VALUE="INFONOM">Nom/Prenom/Telephone/Fonction</OPTION><OPTION VALUE="SUPPR">Pays/BU/Site/Societe</OPTION></SELECT></td>
			</tr>			
			<tr style="display:none" id="divMsgCreaNom">			
        		<td width="150"><label for="msgdmdnom">Nom</label></td>
				<td id="_msgdmdnom"></td>
				<td height="20"><input type="text" class="textInput" name="msgdmdnom" mask="alphanumeric" size="20" id="msgdmdnom" minLength="2" maxlength="30" required></td>
			</tr>			      
			<tr style="display:none" id="divMsgCreaPrenom">			
        		<td width="150"><label for="msgdmdprenom">Prenom</label></td>
				<td id="_msgdmdprenom"></td>
				<td height="20"><input type="text" class="textInput" name="msgdmdprenom" mask="alphanumeric" size="20" id="msgdmdprenom" minLength="2" maxlength="30" required></td>
			</tr>	
			<tr style="display:none" id="divMsgCreaFonction">
				<td><label for="msgdmdfonction">Fonction</label></td>
				<td id="_msgdmdfonction"></td>
				<td height="20"><input type="text" class="textInput" name="msgdmdfonction" mask="ipaddress" size="20" id="msgdmdfonction" minLength="7" maxlength="15"></td>
			</tr>	 
			<tr style="display:none" id="divMsgCreaTel">
				<td><label for="msgdmdtel"><?PHP echo $Telephone; ?></label></td>
				<td id="_msgdmdtel"></td>
				<td height="20"><input type="text" class="textInput" name="msgdmdtel" mask="macaddress" size="20" id="msgdmdtel" minLength="7" maxlength="17"></td>
			</tr>
			<tr style="display:none" id="divMsgDmdEmail">
				<td><label for="msgemailusr">Email </label></td>
				<td id="_msgemailusr"></td>
				<td height="20"><input type="text" class="textInput" name="msgemailusr" mask="mail" size="20" id="msgemailusr" minLength="7" maxlength="80" required></td>
			</tr>	
			<tr style="display:none" id="divMsgDmdSite">
				<td height="20"><?PHP echo $Site; ?></td>
				<td></td>
				<td><?PHP echo ListeSites(); ?></td>
			</tr>    
			<tr style="display:none" id="divMsgDmdSociete">
				<td><?PHP echo $Company; ?></td>
				<td></td>
				<td height="20"><?PHP echo ListeSociete(); ?></td>
			</tr>                           
		</table></fieldset></td><td><b><center><?PHP echo $Informations,' : ',$Administratives; ?></center></b><fieldset class="FieldsetValidator"> 
    <table>	 
			<tr style="display:none" id="divMsgDmdTitle">
				<td><label for="titredmdmsg">Titre de la demande</label></td>
				<td id="_titredmdmsg"></td>
				<td height="20"><input type="text" class="textInput" name="titredmdmsg" mask="alphanumeric" size="20" id="titredmdmsg" minLength="3" maxlength="40" required></td>
			</tr>	 
			<tr>
				<td colspan="2"><label for="descrdmdmsg">Description /<br />Commentaires</label></td>
				<td height="100"><textarea class="BigtextareaInput" name="descrdmdmsg"></textarea></td>
			</tr>	   
    </table></fieldset></td></tr>
    		<tr>
				<td colspan="2"><center>
					<input type="button" id="mySubmitDmdMsg" class="FormButtonGal" value="<?PHP echo $Record,' ',$the,' ',$Request; ?>" onclick="return validateForm()"> &nbsp; 
					<input type="reset" class="FormButtonGal" value="<?PHP echo $Reset,' ',$the,' ',$Form; ?>">
				</center></td>
			</tr>
    </table>        
	</form>
	</fieldset>	
</div></div>


<script type="text/javascript">

function showCreateMsgMail(i) {
	var divMsgCreaNom = document.getElementById('divMsgCreaNom');
	var divMsgCreaPrenom = document.getElementById('divMsgCreaPrenom');
	var divMsgCreaTel = document.getElementById('divMsgCreaTel');
	var divMsgCreaFonction = document.getElementById('divMsgCreaFonction');
	var divMsgDmdEmail = document.getElementById('divMsgDmdEmail');
	var divMsgDmdTitle = document.getElementById('divMsgDmdTitle');
	var divMsgDmdSite = document.getElementById('divMsgDmdSite');
	var divMsgDmdSociete = document.getElementById('divMsgDmdSociete');
	var divMsgModifCpt = document.getElementById('divMsgModifCpt');
	switch(i) {
		case 1 : 	divMsgModifCpt.style.display = 'none';
					divMsgCreaNom.style.display = ''; 
					divMsgCreaPrenom.style.display = ''; 
					divMsgCreaFonction.style.display = ''; 
					divMsgCreaTel.style.display = ''; 
					divMsgDmdEmail.style.display = 'none'; 
					divMsgDmdTitle.style.display = 'none';
					divMsgDmdSite.style.display = '';
					divMsgDmdSociete.style.display = '';
					break;
		case 2 : 	divMsgModifCpt.style.display = 'none';
					divMsgCreaNom.style.display = 'none'; 
					divMsgCreaPrenom.style.display = 'none'; 
					divMsgCreaFonction.style.display = 'none'; 
					divMsgCreaTel.style.display = 'none';
					divMsgDmdEmail.style.display = ''; 
					divMsgDmdTitle.style.display = 'none';
					divMsgDmdSite.style.display = 'none';
					divMsgDmdSociete.style.display = 'none';					
					break;
		case 3 : 	divMsgModifCpt.style.display = '';
					divMsgCreaNom.style.display = 'none'; 
					divMsgCreaPrenom.style.display = 'none'; 
					divMsgCreaFonction.style.display = 'none'; 
					divMsgCreaTel.style.display = 'none';
					divMsgDmdEmail.style.display = ''; 
					divMsgDmdTitle.style.display = '';
					divMsgDmdSite.style.display = 'none';
					divMsgDmdSociete.style.display = 'none';					
					break;
		case 4 : 	divMsgModifCpt.style.display = 'none';
					divMsgCreaNom.style.display = ''; 
					divMsgCreaPrenom.style.display = ''; 
					divMsgCreaFonction.style.display = ''; 
					divMsgCreaTel.style.display = 'none';
					divMsgDmdEmail.style.display = ''; 
					divMsgDmdTitle.style.display = 'none';
					divMsgDmdSite.style.display = 'none';
					divMsgDmdSociete.style.display = 'none';					
					break;					
		case 5 : 	divMsgModifCpt.style.display = 'none';
					divMsgCreaNom.style.display = 'none'; 
					divMsgCreaPrenom.style.display = 'none'; 
					divMsgCreaFonction.style.display = 'none'; 
					divMsgCreaTel.style.display = 'none';
					divMsgDmdEmail.style.display = ''; 
					divMsgDmdTitle.style.display = '';
					divMsgDmdSite.style.display = 'none';
					divMsgDmdSociete.style.display = 'none';					
					break;
		default: 	divMsgModifCpt.style.display = 'none';
					divMsgCreaNom.style.display = 'none'; 
					divMsgCreaPrenom.style.display = 'none'; 
					divMsgCreaFonction.style.display = 'none'; 
					divMsgCreaTel.style.display = 'none'; 
					divMsgDmdEmail.style.display = 'none'; 
					divMsgDmdTitle.style.display = 'none';		
					divMsgDmdSite.style.display = 'none';
					divMsgDmdSociete.style.display = 'none';
					break;
	}
}

function showModifMsgCpt(i) {
	var divMsgCreaNom = document.getElementById('divMsgCreaNom');
	var divMsgCreaPrenom = document.getElementById('divMsgCreaPrenom');
	var divMsgCreaTel = document.getElementById('divMsgCreaTel');
	var divMsgCreaFonction = document.getElementById('divMsgCreaFonction');
	var divMsgDmdSite = document.getElementById('divMsgDmdSite');
	var divMsgDmdSociete = document.getElementById('divMsgDmdSociete');
	switch(i) {
		case 1 : 	divMsgCreaNom.style.display = ''; 
					divMsgCreaPrenom.style.display = ''; 
					divMsgCreaFonction.style.display = ''; 
					divMsgCreaTel.style.display = ''; 
					divMsgDmdSite.style.display = 'none';
					divMsgDmdSociete.style.display = 'none';
					break;
		case 2 : 	divMsgCreaNom.style.display = 'none'; 
					divMsgCreaPrenom.style.display = 'none'; 
					divMsgCreaFonction.style.display = 'none'; 
					divMsgCreaTel.style.display = 'none';
					divMsgDmdSite.style.display = '';
					divMsgDmdSociete.style.display = '';					
					break;
		default: 	divMsgCreaNom.style.display = 'none'; 
					divMsgCreaPrenom.style.display = 'none'; 
					divMsgCreaFonction.style.display = 'none'; 
					divMsgCreaTel.style.display = 'none'; 		
					divMsgDmdSite.style.display = 'none';
					divMsgDmdSociete.style.display = 'none';
					break;
	}
}

function validateForm()
{
	var nbErrors = 0;
	var msgError = "";
	var requestChoice = document.forms["FormDmdMsg"]["msgdmdcateg"].value;
	if (requestChoice = "SUPPR") {
		alert("Suppression");
		if (verifMail() = false) { nbErrors++; msgError = "Adresse email invalide"; }
		alert(msgError); 
	}
	
}

function verifMail() {
	var msgemailusr = document.forms["FormDmdMsg"]["msgemailusr"].value;
	var atpos = msgemailusr.indexOf("@xxxx.com");
	if (atpos < 1)
	  {
	  alert("Not a valid e-mail address");
	  return false;
	  }
	return true;
}


</script>

<?PHP  }  else { 
  echo $No_valid_access_page;
  header("Refresh:0;url=''");  
}
unset($ValidAccess); ?>
