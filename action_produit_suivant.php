<?php
session_start();
include ("db.php");
$_SESSION['reference'] = htmlspecialchars($_POST['ref']);	
$_SESSION['zone'] = $_SESSION["zone"];
$zonechoose	=	 $_SESSION["zone"];
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
	
	<div class="content">
		<div class="title-head"><h1><center>ZONE :<br><u><?php echo $zonechoose ?></u></center></h1></div>
		
	</div>
<?php
$A = htmlspecialchars($_POST['ref']);
$sql = $db->query("SELECT * FROM allref WHERE REF = $A"); 
$filename = "img/$A.jpg";

    if($sql->rowCount() > 0) 
    { 
			if (file_exists($filename)) {    //Vérifie si le fichier existe et renvoie la bonne photo ou la photo de demande.
				echo "<img src='img/$A.jpg' width='180px' height='200px'><br><table border='3'>";
			} else {
				echo "
				<DIV align='left' STYLE='font-family: Arial Black; color: black; font-size: 20pt; margin-top: -20pt'>
				 <p>Bobine normalement pas au dépot					 
				</DIV>";
			}
              
        $row = $sql->fetch();
		$_SESSION['table'] = "allref";        
    } 
	else{ //Sinon fait la requte sur la table oldref et affiche un message comme quoi la rfrence ne doit pas tre en stock normalement
	 $sql2 = $db->query("SELECT * FROM oldref WHERE REF = $A"); 	
	 if($sql2->rowCount() > 0)
		{
			echo "
				<DIV align='left' STYLE='font-family: Arial Black; color: black; font-size: 20pt; margin-top: -20pt'>
				 <p>Bobine normalement pas au dépot					 
				</DIV>";
			if (file_exists($filename)) {    //Vérifie si le fichier existe et renvoie la bonne photo ou la photo de demande.
				echo "<img src='img/$A.jpg' width='180px' height='200px'><br><table border='3'>";
			} else {
				echo "
				<DIV align='left' STYLE='font-family: Arial Black; color: black; font-size: 20pt; margin-top: -20pt'>
				 <p>Bobine normalement pas au dépot					 
				</DIV>";
			}
              
        $row = $sql2->fetch(); 
		$_SESSION['table'] = "oldref";        
    	} 
	}     
?>


<form id="Form1" action="action2.php" method="post">
 <label>
  <input id="check1" type="checkbox" name="DECHETMODIF" value="1" <?php if($row['DECHET'] == 1) echo 'checked'?> >
    DECHET</label>
<br/>
<table border="2">		
			<tr>
			<td class='police'>REF</td>
			<td class='police'>CODE</td>
			<td class='police'>Famille</td>
			<td class='police'>Details</td>
			<td class='police'>Fibre</td>
			<td class='police'>Couleur</td>
			<td class='police'>Back</td>
			<td class='police'>GRS</td>
			<td class='police'>Largeur</td>
			<td class='police'>Longueur</td>
			<td class='police'>HDIAM</td>
			
			</tr>
			<tr>
			<td class='police'><?php echo $row['REF']?></td>
			<td class='police'><?php echo $row['CODE']?></td>
			<td class='police'><?php echo $row['FAM']?></td>
			<td class='police'><?php echo $row['DETAIL']?></td>
			<td class='police'><?php echo $row['FIBRE']?></td>
			<td class='police'><?php echo $row['COULEUR']?></td>
			<td class='police'><?php echo $row['BACK']?></td>
			<td class='police'><?php echo $row['GRS']?></td>
			<td class='police'><?php echo $row['LARG']?></td>
			<td class='police'><?php echo $row['LONG']?></td>
			<td class='police'><?php echo $row['HDIAM']?></td>
			</tr>

			<tr>
			<td class='police'></td>
			<td class='police'><input type="text" name="CODEMODIF" style="width:60px; height:30px" value="<?= isset($_POST['CODE']) ? $_POST['CODE'] : ''; ?>" autofocus/> </td>
			<td class='police'></td>
			<td class='police'><textarea class="police" class="police" name="DETAILMODIF" style="width:150px; height:50px;" /></textarea></td>
			<td class='police'><input type="text" name="FIBREMODIF" style="width:150px; height:30px;" /></td>
			<td class='police'><textarea class="police" name="COULEURMODIF" style="width:250px; height:50px;" /></textarea></td>
			<td class='police'><input type="text" name="BACKMODIF" style="width:150px; height:30px;" /></td>
			<td class='police'><input type="text" name="GRSMODIF" style="width:50px; height:30px;" /></td>
			<td class='police'><input type="text" name="LARGMODIF" style="width:50px; height:30px;" /></td>
			<td class='police'><input type="text" name="LONGMODIF" style="width:50px; height:30px;" /></td>
			<td class='police'><input type="text" name="HDIAMMODIF" style="width:50px; height:30px;" /></td>
			
			</tr>


			<tr>
			<tr>
			<tr>
			<tr>
			<td class='police'>PDNET</td>
			<td class='police'>PBRUT</td>
			<td class='police'>Marque</td>
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
			<td class='police'><?php echo $row['PNET']?></td>
			<td class='police'><?php echo $row['PBRUT']?></td>
			<td class='police'><?php echo $row['MARQUE']?></td>
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
			<td class='police'><input type="text" name="PNETMODIF" style="width:50px; height:30px;" /></td>
			<td class='police'><input type="text" name="PBRUTMODIF" style="width:50px; height:30px;" /></td>
			<td class='police'><input type="text" name="MARQUEMODIF" style="width:50px; height:30px;" /></td>
			<td class='police'><textarea class="police" name="REMARQUEMODIF" style="width:150px; height:50px;" /></textarea></td>
			<td class='police'><textarea class="police" name="DEFAUTMODIF" style="width:150px; height:50px;" /></textarea></td>
			<td class='police'><textarea class="police" name="ACTIONMODIF" style="width:250px; height:50px;" /></textarea></td>
			<td class='police'><textarea class="police" name="CONDITIONMODIF" style="width:150px; height:50px;" /></textarea></td>
			<td class='police'><input type="text" name="MANDRINMODIF" style="width:50px; height:30px;" /></td>
			<td class='police'><input type="text" name="NBMODIF" style="width:50px; height:30px;" /></td>
			<td class='police'><b><?php echo "$zonechoose" ?></b></td>
			<td class='police'><textarea class="police" name="COM_INV" style="width:250px; height:50px;" /></textarea></td>
			</tr>	
	
</table>
<table>
	 
	   <tr><td><input class="valid" type="button" value="Validation" onClick="confirmDechet();" /></td>
	</form>
		

	<form action="index.php" method="post">
		<td><input class="cancel" type="submit" value="X"/></td></tr>
	</form>
</table>

	</body>

