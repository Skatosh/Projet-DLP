<!DOCTYPE html >
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<!--[if lt IE 9]>
		    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="style/style-l-ecole-theatrale-russe.css" rel="stylesheet" media="all" type="text/css">
		
		<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.2.js"></script>
		<link rel="icon" type="image/png" href="/images-design/mafavicon-1.ico" />
	</head>

<body>
	<?php
		include(dirname(__FILE__)."/header.php");
	?>
	<section class="conteneur-superieur">	
	<div class="conteneur">
	<?php
		include("auth.php");
		include("db_config.php");
		$conn = mysql_connect($DB_host, $DB_login, $DB_pass);
		if (!$conn) { die('Erreur de connexion: ' . mysql_error()); }
		$db = mysql_select_db($DB_select, $conn);
		
		if(isset($_GET['cid']) && isset($_SESSION['AUTH']) == 1)//ADMIN
		{
			$cid =mysql_real_escape_string($_GET['cid']);
			$SQL="SELECT * FROM membre WHERE cid='$cid'";
			$result=mysql_query($SQL);
			$tab=mysql_fetch_array($result);
			$nom=htmlspecialchars($tab['nom']);
			$prenom=htmlspecialchars($tab['prenom']);
			$photo=htmlspecialchars($tab['photo']);
			if(mysql_num_rows($result)==0)
			{
				?>
					<script>
						alert('Ce membre n\'existe pas !');
					</script>
				<?php
			}
			else
			{
				$SQL="INSERT INTO collectif (nom, prenom, photo) VALUES ('$nom','$prenom','$photo') ";
				
				$result = mysql_query($SQL);
				if($result)
				{
					
					?>
						<p>
							<h2 style="padding-left: 30px">Collectif bien ajouter<h2>
						</p>
					<?php
				}
				else
				{
					?>
						<script>
							alert('PROBLEME BASE DE DONNEES');
						</script>
					<?php
				}
			}
		}
		?><h1><a href="index.php">Retourner a l'accueil</a></h1><?php
		mysql_close($conn);
	?>
<!--Fin div conteneur-->
		</div>
		
		<?php
			include(dirname(__FILE__)."/barre-laterale.php");
		?>
	<!--Fin section conteneur-superieur-->
	</section>

	<?php
		include(dirname(__FILE__)."/footer.php");
	?>
</body>
</html>