<?php
session_start();
$A = $_SESSION["reference"];
$B = $_SESSION["zone"];
$C = $_SESSION["table"];
include ("db.php");

//Recupration rsultat requte REF
$sql = $db->query("SELECT * FROM $C WHERE REF = '$A' ");
$fetch = $sql->fetch();
extract($fetch);

if(isset($_POST['REFMODIF'])){
	$REFinv		= $_POST['REFMODIF']; 
}
else{
	$REFinv		=	 0 ;  //Le checkbox n'a pas été cochée
}
$CODEinv	=	$_POST['CODEMODIF'];
$DETAILinv	=	$_POST['DETAILMODIF'];
$FIBREinv	=	 $_POST['FIBREMODIF'];
$COULEURinv	=	 $_POST['COULEURMODIF'];
$BACKinv		=	 $_POST['BACKMODIF'];
$GRSinv		=	 $_POST['GRSMODIF'];
$LARGinv		=	 $_POST['LARGMODIF'];
$LONGinv		=	 $_POST['LONGMODIF'];
$HDIAMinv		=	 $_POST['HDIAMMODIF'];
$PNETinv	=	 $_POST['PNETMODIF'];
$PBRUTinv		=	 $_POST['PBRUTMODIF'];
$MARQUEinv	=	 $_POST['MARQUEMODIF'];
$REMARQUEinv	=	 $_POST['REMARQUEMODIF'];
$DEFAUTinv	=	 $_POST['DEFAUTMODIF'];
$ACTIONinv		=	 $_POST['ACTIONMODIF'];
$CONDITIONinv		=	 $_POST['CONDITIONMODIF'];
$MANDRINinv	=	 $_POST['MANDRINMODIF'];
$NBinv		=	 $_POST['NBMODIF'];
$COMinv		=	 $_POST['COM_INV'];
if(isset($_POST['DECHETMODIF'])){
	$DECHET		= $_POST['DECHETMODIF']; 
}
else{
	$DECHET		=	 0 ;  //Le checkbox n'a pas été cochée
}
	
$query1 = $db->query ("INSERT INTO `inventaire`(`REF`, `CODE`, `FAM`, `DETAIL`, `FIBRE`, `COULEUR`, `BACK`, `GRS`, `LARG`, `LONG`, `HDIAM`, `PNET`, `PBRUT`, `MARQUE`, `REMARQUE`, `DEFAUT`, `ACTION`, `INT_CONDITION`, `MANDRIN`, `NB`, `DP_CODE`, `COM_DE`, `REFinv`, `CODEinv`, `DETAILinv`, `FIBREinv`, `COULEURinv`, `BACKinv`, `GRSinv`, `LARGinv`, `LONGinv`, `HDIAMinv`, `PNETinv`, `PBRUTinv`, `MARQUEinv`, `REMARQUEinv`, `DEFAUTinv`, `ACTIONinv`, `INT_CONDITIONinv`, `MANDRINinv`, `NBinv`, `DP_CODEinv`, `COM_INV`, `DECHET`)
VALUES ('$REF','$CODE','$FAM','$DETAIL','$FIBRE','$COULEUR','$BACK','$GRS','$LARG','$LONG','$HDIAM','$PNET','$PBRUT','$MARQUE',
'$REMARQUE','$DEFAUT','$ACTION','$INT_CONDITION','$MANDRIN','$NB','$DP_CODE','$COM_DE','$REFinv','$CODEinv','$DETAILinv','$FIBREinv','$COULEURinv','$BACKinv',
'$GRSinv','$LARGinv','$LONGinv','$HDIAMinv','$PNETinv','$PBRUTinv','$MARQUEinv','$REMARQUEinv','$DEFAUTinv','$ACTIONinv',
'$CONDITIONinv','$MANDRINinv','$NBinv','$B','$COMinv','$DECHET')");


?>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" type="text/css" />
		<title>Prodiconseil: Inventaire</title>		
	</head>
<body>
	<div class="content">
		<div class="title-head"><h6><center><br><?php echo "L'insertion du produit " . $A;echo " a ete effectue"; ?></center></h6></div>
		
	</div>

<div class="product">	

	<form action="produit_suivant.php" method="post">
	<td><input class="valid1" type="submit" value="Produit suivant"/></td></tr>
	</form>


	<form action="zone_suivante.php" method="post">
	<td><input class="valid1" type="submit" value="Zone Suivante"/></td></tr>
	</form>

	<form action="index.php" method="post">
	<td><input class="valid1" type="submit" value="Allee Suivante"/></td></tr>	
	<td><input class="cancel" type="submit" value="Retour a l'accueil"/></td></tr>	
	<td><input class="valid" type="submit" value="TERMINER"/></td></tr>
	</form>
</div>
	</div>
</body>
