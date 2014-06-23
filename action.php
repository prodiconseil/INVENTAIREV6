<?php
session_start();
require "class/Session.php";
if(isset($_POST['ref']) && !is_numeric($_POST['ref'])){
	Session::setFlash("Veuillez préciser une référence valide", "error");
	header('Location:index.php');
	die();
}
include ("db.php");
$_SESSION['reference'] = htmlspecialchars($_POST['ref']);	
$_SESSION['zone'] = $_POST['zone'];
$zonechoose	=	 $_POST['zone'];
$R = $_SESSION['reference'];

$sqlInventaire = $db->query("SELECT * FROM inventaire WHERE REF = $R"); 
if($sqlInventaire->rowCount() > 0) //Verifie si le produit existe déjà dans l'inventaire
    { 
		header('Location: action_doublure.php');
    } 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" type="text/css" />
		<title>Prodiconseil: Inventaire</title>
		<SCRIPT type="text/javascript"> 
		 function confirmDechet() { 
		  if (document.getElementById("check1").checked == true) { 
			   if (confirm("Vous etes sur que c'est un dechet")) { 
			   document.getElementById("Form1").submit(); 
			  }
			  else{
				 return false;
				}
			 }
		 else{
			 document.getElementById("Form1").submit(); 
			}  
		  }
		  
  </SCRIPT> 
	</head>
	<body>
	<table width="100" border="0" cellspacing="0" cellpadding="0"> 
	<tr>
	
<?php
$A = htmlspecialchars($_POST['ref']);
$sql = $db->query("SELECT * FROM allref WHERE REF = $A"); 
$filename = "img/$A.jpg";

    if($sql->rowCount() > 0) 
    { 
			if (file_exists($filename)) {    //Vérifie si le fichier existe et renvoie la bonne photo ou la photo de demande.
				echo "<td><br><img src='img/$A.jpg' width='180px' height='200px'></td>";
			} else {
				echo "<td><br>
				<DIV align='left' STYLE='font-family: Arial Black; color: black; font-size: 20pt; margin-top: -20pt'>
				 <p>Merci de prendre une photo si possible<br><br>						 
				</DIV></td>";
			}
              
        $row = $sql->fetch();
		$_SESSION['table'] = "allref";        
    } 
	else{ //Sinon fait la requete sur la table oldref et affiche un message comme quoi la rfrence ne doit pas etre en stock normalement
	 $sql2 = $db->query("SELECT * FROM oldref WHERE REF = $A"); 	
	 if($sql2->rowCount() > 0)
		{
			echo "<td><br>
			<DIV align='left' STYLE='font-family: Arial Black; color: black; font-size: 20pt; margin-top: -20pt'>
				 <p>Bobine normalement pas au dépot					 
			</DIV></td>";
			if (file_exists($filename)) {    //Vérifie si le fichier existe et renvoie la bonne photo ou la photo de demande.
				echo "<td><br><img src='img/$A.jpg' width='180px' height='200px'></td>";
			} else {
				echo "<td><br>
				<DIV align='left' STYLE='font-family: Arial Black; color: black; font-size: 20pt; margin-top: -20pt'>
				 <p>Merci de prendre une photo si possible<br><br>						 
				</DIV></td>";
			}
              
        $row = $sql2->fetch(); 
		$_SESSION['table'] = "oldref";        
    	} 
	}     
	?>
	<td><div class="content">
		<div class="title-head"><h1><center><font color="black"><u>zone</u> :</font><?php echo $zonechoose ?></center><br></h1></div>
		
	</div></td></tr>
	<tr>
		<td><form id="Form1" action="action2.php" method="post">
			<div class="checkbox">
			   <input id="check1" type="checkbox" name="DECHETMODIF" value="1" <?php if($row['DECHET'] == 1) echo 'checked'?> >
			   <label for="check1">DECHET</label>
			</div></td>
		<td>
		<table>
	 		 <tr><td><input class="valid" type="submit" value="Validation" onClick="confirmDechet();" /></td>
			<td><input class="cancel" type="button" value="X" onClick="location.href='index.php'"/></td></tr>
	</table>
	</td>
	</tr>
</table>
  <br>
<table border="2">			
			<tr>
			<td class='police'>REF</td>
			<td class='police'>CODE</td>
			<td class='police'>Famille</td>
			<td class='police'>Details</td>
			<td class='police'>Fibre</td>
			<td class='police'>Couleur</td>
			<td class='police'>Back</td>		
			
			</tr>
			<tr>
			<td class='police'><?php echo $row['REF']?></td>
			<td class='police'><?php echo $row['CODE']?></td>
			<td class='police'><?php echo $row['FAM']?></td>
			<td class='police'><?php echo $row['DETAIL']?></td>
			<td class='police'><?php echo $row['FIBRE']?></td>
			<td class='police'><?php echo $row['COULEUR']?></td>
			<td class='police'><?php echo $row['BACK']?></td>			
			</tr>

			<tr>
			<td class='police'></td>
			<td class='police'><input class="police" type="text" name="CODEMODIF" style="width:100px; height:50px" value="<?= isset($_POST['CODE']) ? $_POST['CODE'] : ''; ?>" autofocus/> </td>
			<td class='police'></td>
			<td class='police'><textarea class="police" class="police" name="DETAILMODIF" style="width:200px; height:80px;" /></textarea></td>
			<td class='police'><input type="text" name="FIBREMODIF" style="width:50px; height:80px;" /></td>
			<td class='police'><textarea class="police" name="COULEURMODIF" style="width:150px; height:80px;" /></textarea></td>
			<td class='police'><input type="text" name="BACKMODIF" style="width:100px; height:80px;" /></td>

			</tr>
 

			<tr>
			<tr>
			<tr>
			<tr>
			<td class='police'>GRS</td>
			<td class='police'>Largeur</td>
			<td class='police'>Longueur</td>
			<td class='police'>HDIAM</td>
			<td class='police'>PDNET</td>
			<td class='police'>PBRUT</td>
			<td class='police'>Marque</td>
			
			</tr>	
			
			<tr>
			<td class='police'><?php echo $row['GRS']?></td>
			<td class='police'><?php echo $row['LARG']?></td>
			<td class='police'><?php echo $row['LONG']?></td>
			<td class='police'><?php echo $row['HDIAM']?></td>
			<td class='police'><?php echo $row['PNET']?></td>
			<td class='police'><?php echo $row['PBRUT']?></td>
			<td class='police'><?php echo $row['MARQUE']?></td>			
			</tr>

			<tr>
			<td class='police'><input type="text" name="GRSMODIF" style="width:50px; height:80px;" /></td>
			<td class='police'><input type="text" name="LARGMODIF" style="width:50px; height:80px;" /></td>
			<td class='police'><input type="text" name="LONGMODIF" style="width:50px; height:80px;" /></td>
			<td class='police'><input type="text" name="HDIAMMODIF" style="width:50px; height:80px;" /></td>
			<td class='police'><input class='police' type="text" name="PNETMODIF" style="width:50px; height:80px;" /></td>
			<td class='police'><input class='police' type="text" name="PBRUTMODIF" style="width:50px; height:80px;" /></td>
			<td class='police'><input class='police' type="text" name="MARQUEMODIF" style="width:100px; height:80px;" /></td>			
			</tr>

			<tr>
			<td class='police'>Remarque</td>
			<td class='police'>Defaut</td>
			<td class='police'>Action</td>
			<td class='police'>Int_Condition</td>
			<td class='police'>Mandrin</td>
			<td class='police'>Nombre</td>
			<td class='police'>DP_Code</td>
			<td class='police'>Commentaire_DE</td>
			</tr>

			<tr>
			<td class='police'><?php echo $row['REMARQUE']?></td>
			<td class='police'><?php echo $row['DEFAUT']?></td>
			<td class='police'><?php echo $row['ACTION']?></td>
			<td class='police'><?php echo $row['INT_CONDITION']?></td>
			<td class='police'><?php echo $row['MANDRIN']?></td>
			<td class='police'><?php echo $row['NB']?></td>
			<td class='police'><?php echo $row['DP_CODE']?></td>
			<td class='police'><?php echo $row['COM_DE']?></td>
			</tr>
			<tr>
			<td class='police'><textarea class="police" name="REMARQUEMODIF" style="width:160px; height:80px;" /></textarea></td>
			<td class='police'><textarea class="police" name="DEFAUTMODIF" style="width:150px; height:80px;" /></textarea></td>
			<td class='police'><textarea class="police" name="ACTIONMODIF" style="width:150px; height:80px;" /></textarea></td>
			<td class='police'><textarea class="police" name="CONDITIONMODIF" style="width:150px; height:80px;" /></textarea></td>
			<td class='police'><input class='police' type="text" name="MANDRINMODIF" style="width:50px; height:80px;" /></td>
			<td class='police'><input class='police' type="text" name="NBMODIF" style="width:50px; height:80px;" /></td>
			<td class='police'><b><?php echo "$zonechoose" ?></b></td>
			<td class='police'><textarea class="police" name="COM_INV" style="width:250px; height:80px;" /></textarea></td></tr>
			</form>
</table>	
</body>


