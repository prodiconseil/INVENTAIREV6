<?php require_once('db.php'); ?>
<?php 
session_start();
$search_a = $db->query("SELECT max(REF) FROM allref WHERE REF BETWEEN '805999' AND '807000'");
$search_allref = $search_a->fetch();
$search_o = $db->query("SELECT max(REF) FROM oldref WHERE REF BETWEEN '805999' AND '807000'");
$search_oldref = $search_o->fetch();
$search_inv = $db->query("SELECT max(REF) FROM inventaire WHERE REF BETWEEN '805999' AND '807000'");
$search_inventaire = $search_inv->fetch();
$maxi = max ($search_oldref,$search_allref,$search_inventaire); 
$maxi1 = intval($maxi['max(REF)']) + 1;
if($maxi1 < 806000) $maxi1 = 806000;
$B = $_SESSION["zone"];
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Index Inventaire</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
	.container{
		display: block;
		width: 100%;
	}
	.fisrt{
		display: block;
		float: left;
	}
	#content2{
		display: block;
	}
	</style>
</head>
<body>
	<div class="content">
		<div class="title-head"><h1><center>Inventaire</center></h1></div>
		
	</div>

	<div class="container">
		<div class="fisrt">
	

 </body>


<div class="content">
		<div class="title-head"><br><?php echo "La zone est : " .$B ;?></div>
		
</div>

<div class="product">
<form  action="action_produit_suivant.php" method="post">
<p> Réference : <input type="text" name="ref" /></p>
<p><input class ="valid1" type="submit" value="Accepter"></p>
</form>		

<form action="index.php" method="post">
<p><input class="retour" type="submit" value="Retour Accueil"></p>
</form>	


<form action="action_nouveau.php" method="post" >
<input type="hidden" name="max_ref" value="<?= $maxi1; ?>"/>
<input type="hidden" name="zone" value="<?=$B?>">
<p><input class="retour" type="submit" value="Nouveau Produit"></p>
</form>


</div>






</html>
