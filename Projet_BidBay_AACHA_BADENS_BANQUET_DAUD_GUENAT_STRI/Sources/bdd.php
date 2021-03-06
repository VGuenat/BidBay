<?php
	function connectBDD() {
		// Infos de connexion
		$db = "postgres";
		$user = "postgres";
		$pass = "postgres";
		// Connexion
		$connect = pg_connect("dbname=$db user=$user password=$pass")
   		or die("Erreur de connexion");
		return $connect ;
	}
	function requeteBDD($query) {
		
		$connect = connectBDD();
		$result = pg_exec($connect,$query);
		return $result;
		
	}
	//function derniersobjets(){
	//}
	function getnbvente($mailuser){
	
		$achats = "SELECT COUNT (*) FROM objet WHERE mailvendeur='$mailuser'; ";
		$ventes = "SELECT COUNT (*) FROM objet WHERE mailacheteur='$mailuser'; ";
		$rstventes = requeteBDD($achats);
		$rstachats = requeteBDD($ventes);
		$rowA = pg_fetch_array($rstachats);
		$rowV = pg_fetch_array($rstventes);
		$array = array('nbventes' => $rowV[0] , 'nbachats' => $rowA[0] );
		return $array;
	}
	function getinfouser($iduser){
		$query = "SELECT * FROM utilisateur WHERE mailutilisateur = '$iduser'; ";
		$result = requeteBDD($query);
		$row = pg_fetch_array($result);	
		$ventes = getnbvente($iduser);
		$objet = array('iduser' => $iduser, 'nomuser' => $row[3], 'nbventes' => $ventes['nbventes'], 'nbachats' => $ventes['nbachats']  );
		return $objet;
	}
	function getinfoobjet($idobjet){
		$query = "SELECT * FROM objet WHERE idobjet = '$idobjet'; ";
		$result = requeteBDD($query);
		$row = pg_fetch_array($result);	
		$querynom = "SELECT prenom FROM utilisateur WHERE mailutilisateur = '$row[9]' ;";
 		$nom = requeteBDD($querynom);
		$nomvendeur = pg_fetch_all_columns($nom);
		$objet = array('idobjet' => $row[0], 'nomobj' =>$row[1], 'prixinit' => $row[2],
		 'descriptionobj' => $row[5], 'mailvendeur' => $row[9], 'nomvendeur' => $nomvendeur[0] );
		
		return $objet;
	}
	
	function getlastidobjet(){
		$query = "SELECT idobjet FROM objet ORDER BY idobjet DESC LIMIT 6 ;";
		$result = requeteBDD($query);
		$array =  pg_fetch_all_columns($result, 0);
		return $array;
		
	} 
	function getlastvente(){
		$query = "SELECT idobjet FROM objet WHERE datelimitevente < now() ORDER BY datelimitevente LIMIT 6 ;";
		$result = requeteBDD($query);
		$array =  pg_fetch_all_columns($result, 0);
		return $array;
		
	}
	function getbestvendeur(){
		$query = "SELECT mailutilisateur FROM utilisateur LIMIT 6 ;";
		$result = requeteBDD($query);
		$array =  pg_fetch_all_columns($result, 0);
		return $array;
		
	}
	function afficherobjet($idobjet){
		$objet = getinfoobjet($idobjet);
		echo '<div class="scroll-content-item">';
		echo "<h3  style ='float: right'> <a  href=\"objet.php?id=".$objet['idobjet']."\">{$objet['nomobj']}</a> </h3>";
		echo "<h3  style ='clear: both; float: right'> <br /> <a href=\"compteother.php?mail=".$objet['mailvendeur']."\">{$objet['nomvendeur']}</a><br /></h3>";
        $lienimage = "uploads/photoobjet/objet".$idobjet.".jpg";
		$lienimage2 = "uploads/photoobjet/objet".$idobjet.".jpeg";
		$lienimage3 = "uploads/photoobjet/objet".$idobjet.".gif";
		$lienimage4 = "uploads/photoobjet/objet".$idobjet.".png";
		if(!file_exists($lienimage)){
			$lienimage="photo_objet_defaut.png";
		}
		if(file_exists($lienimage2)){
			$lienimage=$lienimage2;
		}else if(file_exists($lienimage3)){
			$lienimage=$lienimage3;
		}else if(file_exists($lienimage4)){
			$lienimage=$lienimage4;
		}
		echo "<img class=\"image\" style=\"position: relative\" src=$lienimage alt=\"$idobjet\">"	;
        echo "<p>Prix :  {$objet['prixinit']} € </p>   ";
        echo "<p>  {$objet['descriptionobj']} </p>";
        echo "</div>";
        
	}
	function afficheruser($iduser){
		$user = getinfouser($iduser);
		echo '<div class="scroll-content-item">';
		echo "<h3  style ='float: center'> <a  href=\"compteother.php?mail=".$user['iduser']."\">{$user['nomuser']}</a> </h3>";
		$lienimage = "uploads/photouser/user".$iduser.".jpg";
		$lienimage2 = "uploads/photouser/user".$iduser.".jpeg";
		$lienimage3 = "uploads/photouser/user".$iduser.".gif";
		$lienimage4 = "uploads/photouser/user".$iduser.".png";
		if(!file_exists($lienimage)){
			$lienimage="photo_profil.jpg";
		}
		if(file_exists($lienimage2)){
			$lienimage=$lienimage2;
		}else if(file_exists($lienimage3)){
			$lienimage=$lienimage3;
		}else if(file_exists($lienimage4)){
			$lienimage=$lienimage4;
		}
        echo "<img class=\"image\" style=\"position: relative\" src=$lienimage >"	;
        echo "<p>Nombre de ventes :  {$user['nbventes']}  </p>   ";
        echo "<p>Nombre d'achats :  {$user['nbachats']} </p>";
        echo "</div>";
       
	}
?>
