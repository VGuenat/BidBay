<?php
	require 'head_foot.php';
	headerHTML();
	session_start();
?>
<?php
	$value = isset($_GET['value']) ? $_GET['value'] : '';
	$login = isset($_GET['login']) ? $_GET['login'] : '';
?>

<h1 class="Tpage">Mot de passe Oublié</h1>
		
		<div class="center">
		<form action="post_mot_de_passe_oublier.php" method="post" enctype="multipart/form-data">
		<?php
			switch ($value){
				case 1:
					echo "<B>merci de saisir votre mail</B>";
					break;
				
				case 2:
					echo "<B>Un mail vous a été envoyé</B>";
					break;
				case 3:
					echo "<B>Votre adresse mail est incorrecte ou alors vous n'êtes pas inscrit sur BidBay</B>";
					break;
			}
		?>
		<h3>Vous avez oublié votre mot de passe BidBay?</h3>
		<p>Pas de problème! Envoyer nous votre email et vous recevrez votre mot de passe dans votre boite mail.<br><br>
		<p>Adresse e-mail</p>
		    <input type="mail" name="mail">
		<input class="bouton_co" type="submit" value="Envoyer"><br><br><br></form></p>
		</div>
<?php
	//require 'headfoot.php';
	footerHTML();
?>