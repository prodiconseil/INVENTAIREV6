<?php session_start(); ?>
<?php require_once('db.php'); ?>
<?php require ('class/Session.php'); ?><?php require_once('db.php'); ?>
<?php 
	$sql = $db->query("SELECT DISTINCT ALLEE FROM zone");
	$fetch = $sql->fetchAll();
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
<script type="text/javascript" src="jquery.js"></script>



<body>
	<div class="content">
		<div class="title-head"><h1><center>Inventaire</center></h1></div>
		 <?= Session::flash(); ?>
		<!--	<form action="index.php" method="post">
				<td><input class="valid" type="submit" value="Mise à jour"/></td></tr>
			</form> -->
</div>
	</div>

	<div class="container">
		<div class="fisrt">
	<form>
<div class="product">		
		<SELECT id="liste" NAME="id">
			<?php foreach ($fetch as $k => $v): ?>
				<option value="<?= $k['ALLEE']; ?>"><?= $v['ALLEE']; ?></option>
			<?php endforeach ?>
		</SELECT>

	</form>
	</div>
	<div id="content">
	</div>
	</div>
</body>
<script type="text/javascript">
    	$(document).ready(function(){       
		   $('#liste').change(function() {
			    var val = $("#liste option:selected").text();
			    
			   $("#content").load("included.php?color=" + val, "#content2"); 
		   }); 
		}); 

</script>




</html>
