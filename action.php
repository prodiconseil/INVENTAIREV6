<?php
session_start();
include ("db.php");
$_SESSION['reference'] = htmlspecialchars($_POST['ref']);	
$_SESSION['zone'] = $_POST['zone'];
$zonechoose	=	 $_POST['zone'];
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
				echo "<img src='img/NOPHOTO.jpg' width='470px' height='200px'><br><table border='3'>";
			}
              
        $row = $sql->fetch();
		$_SESSION['table'] = "allref";        
    } 
	else{ //Sinon fait la requte sur la table oldref et affiche un message comme quoi la rfrence ne doit pas tre en stock normalement
	 $sql2 = $db->query("SELECT * FROM oldref WHERE REF = $A"); 	
	 if($sql2->rowCount() > 0)
		{
			echo "Bobine normalement pas au dépot<br>";
			if (file_exists($filename)) {    //Vérifie si le fichier existe et renvoie la bonne photo ou la photo de demande.
				echo "<img src='img/$A.jpg' width='180px' height='200px'><br><table border='3'>";
			} else {
				echo "<img src='img/NOPHOTO.jpg' width='470px' height='200px'><br><table border='3'>";
			}
              
        $row = $sql2->fetch(); 
		$_SESSION['table'] = "oldref";        
    	} 
	}     
?>
<tr>
	</tr>
	<?php foreach ($row as $value => $key):
		if ($value !== "DECHET"){
		echo '<td>'.$value.'</td>';
		}		
	?>
		
	<?php endforeach ?>
</tr>
<tr>
	<?php foreach ($row as $value => $key):
	
	if ($value !== "DECHET"){
		echo '<td>'.$key.'</td>';
	}?>	 	
	<?php endforeach ?>
</tr>
<form id="Form1" action="action2.php" method="post">
 <label>
  <input id="check1" type="checkbox" name="DECHETMODIF" value="1" <?php if($row['DECHET'] == 1) echo 'checked'?> >
    DECHET</label>
			<tr>
				<td></td>
				<td><input type="text" name="CODEMODIF"  style="width:50px; height:30px" value="<?= isset($_POST['CODE']) ? $_POST['CODE'] : ''; ?>" autofocus/> </td>
				<td></td>
				<td><input type="text" name="DETAILMODIF" style="width:150px; height:30px;" /></td>
				<td><input type="text" name="FIBREMODIF" style="width:50px; height:30px;" /></td>
				<td><input type="text" name="COULEURMODIF" style="width:100px; height:30px;" /></td>
				<td><input type="text" name="BACKMODIF" style="width:100px; height:30px;" /></td>
				<td><input type="text" name="GRSMODIF" style="width:50px; height:30px;" /></td>
				<td><input type="text" name="LARGMODIF" style="width:50px; height:30px;" /></td>
				<td><input type="text" name="LONGMODIF" style="width:50px; height:30px;" /></td>
				<td><input type="text" name="HDIAMMODIF" style="width:50px; height:30px;" /></td>
				<td><input type="text" name="PNETMODIF" style="width:50px; height:30px;" /></td>
				<td><input type="text" name="PBRUTMODIF" style="width:50px; height:30px;" /></td>
				<td><input type="text" name="MARQUEMODIF" style="width:50px; height:30px;" /></td>
				<td><input type="text" name="REMARQUEMODIF" style="width:150px; height:30px;" /></td>
				<td><input type="text" name="DEFAUTMODIF" style="width:150px; height:30px;" /></td>
				<td><input type="text" name="ACTIONMODIF" style="width:150px; height:30px;" /></td>
				<td><input type="text" name="CONDITIONMODIF" style="width:150px; height:30px;" /></td>
				<td><input type="text" name="MANDRINMODIF" style="width:50px; height:30px;" /></td>
				<td><input type="text" name="NBMODIF" style="width:50px; height:30px;" /></td>
				<td><b><?php echo "$zonechoose" ?></b></td>
				<td><input type="textarea" name="COM_INV" style="width:250px; height:30px;" /></td>
				
					
			</tr>

<table>
	 
	   <tr><td><input class="valid" type="button" value="Validation" onClick="confirmDechet();" /></td>
	</form>
		

	<form action="index.php" method="post">
		<td><input class="valid" type="submit" value="X"/></td></tr>
	</form>
	</body>
</table>

