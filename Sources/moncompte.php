<?php
	require 'head_foot.php';
	headerHTML();
	session_start();
	$login = $_SESSION['login'];

?>
<?php
		$db = "postgres";
		$user = "postgres";
		$pass = "postgres";
		$connect = pg_connect("dbname=$db user=$user password=$pass");
		$donnees = pg_exec($connect,"SELECT * FROM utilisateur");
		$var = 0;
		while ($row = pg_fetch_row($donnees)){
			if ( $row[0]==$login){
				$var = 1;
				$_SESSION['passwd'] = $row[1];
				$_SESSION['nom'] = $row[2];
				$_SESSION['prenom'] = $row[3];
				$_SESSION['typeuser'] = $row[4];
				$_SESSION['imageuser'] = $row[5];
				$_SESSION['adresseuser'] = $row[6];
				$_SESSION['telephone'] = $row[7];
				$_SESSION['datenaissanceuser'] = $row[8];
			}
		}
	$login = $_SESSION['login'];
	$passwd = $_SESSION['passwd'];
	$nom = $_SESSION['nom'];
	$prenom =$_SESSION['prenom'];
	$imageuser = $_SESSION['imageuser'];
	$adresseuser = $_SESSION['adresseuser'];
	$telephone = $_SESSION['telephone'];
	$datenaissanceuser = $_SESSION['datenaissanceuser'];
?>
<h1 class="Tpage">Mon Compte</h1>
	<form action="post_photo.php" method="post" enctype="multipart/form-data">
		<div class ="droite1_3">
			<img src="photo_profil.jpg"  width="150" height="150" border=3>
			<br><input type="submit" class="bouton_inscr" value="Modifier"></br>
		</div>
	</form>
	<div class="gauche2_3">
		<form action="form_infoperso.php" method="post" enctype="multipart/form-data">
			</h2><b>Infomations personnelles</b></h2>
				<?php
					echo "<br />\n";
					echo "Votre Nom : $nom";
					echo "<br />\n";
					echo "Votre Prénom : $prenom";
					echo "<br />\n";
					echo "Votre date de naissance : $datenaissanceuser";
					echo "<br />\n";
				?>
			<div class="center">
				<input type="submit" class="bouton_inscr" value="Modifier"></p>
			</div>
		</form>
		<form action="form_infocompte.php" method="post" enctype="multipart/form-data">
			</h2><b>Infomations du compte</b></h2>
				<?php
					echo "<br />\n";
					echo "Votre Mail : $login";
					echo "<br />\n";
					echo "Votre Mot de passe : $passwd";
					echo "<br />\n";
				?>
			<div class="center">
				<input type="submit" class="bouton_inscr" value="Modifier"></p>
			</div>
		</form>
		<form action="form_coordonnees.php" method="post" enctype="multipart/form-data">
			</h2><b>Coordonnées</b></h2>
				<?php
					echo "<br />\n";
					echo "Votre Adresse : $adresseuser";
					echo "<br />\n";
					echo "Votre Telephone : $telephone";
					echo "<br />\n";
				?>
			<div class="center">
				<input type="submit" class="bouton_inscr" value="Modifier"></p>
			</div>
		</form>
	</div>
>>>>>>> Modifs

<?php
	//require 'headfoot.php';
	footerHTML();
?>