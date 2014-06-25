<?php 
	require_once('db.php');
	$color = $db->quote($_GET['color']);
	$sql = $db->query("SELECT * FROM zone WHERE ALLEE = $color");
	$fetch = $sql->fetchAll();
	$search_a = $db->query("SELECT max(REF) FROM allref WHERE REF BETWEEN '805999' AND '807000'");
	$search_allref = $search_a->fetch();
	$search_o = $db->query("SELECT max(REF) FROM oldref WHERE REF BETWEEN '805999' AND '807000'");
	$search_oldref = $search_o->fetch();
	$search_inv = $db->query("SELECT max(REF) FROM inventaire WHERE REF BETWEEN '805999' AND '807000'");
	$search_inventaire = $search_inv->fetch();
	$maxi = max ($search_oldref,$search_allref,$search_inventaire); 
	$maxi1 = intval($maxi['max(REF)']) + 1;
	if($maxi1 < 806000) $maxi1 = 806000; 
	 ?>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		function envoi_form(url){
			document.formulaire.action = url;
			document.formulaire.submit();
		}

	</script>
</head>
<body>

		<div id="content2">
		<div class="product">
		
		<form action="" method="post" name="formulaire">
			<select name="zone">
				<?php foreach ($fetch as $k): ?>
					<option><?= $k['ZONE']; ?></option>
				<?php endforeach ?>
		
			</select>
				<p> Réference : <input type="text" name="ref" /></p>
				<p><input type="submit" onclick="envoi_form('action.php')" value="OK"></p>
				<input type="hidden" name="max_ref" value="<?= $maxi1; ?>"/>
				<input type="submit" onclick="envoi_form('action_nouveau.php')" value="Creation nouveau produit">
				
						
		</form>


		</div>


</body>
</html>
