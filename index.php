<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">

	<title>Liste</title>
	
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css" type="text/css" />

		
</head>



<?php

//**partie connection

// On vérifie que le nom de base de données correspond, mais également le nom d'utilisateur et mot de passe

require_once('./connexion.php');

//OU :
//$bdd = new PDO('mysql:host=localhost;dbname=formation;charset=utf8', 'root', 'root');

//**fin partie connection
//---------------------------------------------------------------
//**partie gestion des lignes (supprimer...
//création de la requête pour effacer

if (isset($_GET['efface'])) {
	
	$produit_a_effacer = intval(trim($_GET['efface']));

	$requete_produits = "DELETE FROM produits WHERE ID = $produit_a_effacer ";
	
	echo "<br> effacer le produit : $produit_a_effacer <br>";
	
		if(!$bdd->query($requete_produits)){
			
		print_r($bdd->errorInfo());
		}
}

//** fin partie gestion des lignes
//------------------------------------------------------------------
//** partie tableau : affichage des produits

echo "<h1>Tableau 'Liste de courses'</h1>";

//récupération des produits et de leur quantité

$requete = "SELECT * FROM produits";

if ($req_produits = $bdd->query($requete)) {
	$produits = $req_produits->fetchAll();
	
//création d'une variable poubelle pour icone

$poub = "<i class='fa fa-trash-o' aria-hidden='false'></i>";
	
//initialisation du tableau
	
	echo "<TABLE BORDER CELLPADDING=10 CELLSPACING=0>";
		
		echo "<TR class = 'fond_th'>";
			echo "<TH >Nom produit</TH> <TH>Quantité</TH> <TH>Valider</TH> <TH>Supprimer</TH>";
		echo "</TR>";	
	
//calcul des lignes	
		
			foreach  ($produits as $row) {
				
//affichage du tableau
		
		echo "<TR class = 'centrer'>";
			
			echo "<TD >";
				echo $row['nom_produit'] ;
			echo"</TD>" ;
			
			echo "<TD>";
				echo $row['quantite_produit'] ; 
			echo"</TD>" ;
			
			echo "<TD>";
				echo "<input type='checkbox'>" ;
			echo"</TD>" ;
			
			echo "<TD class = 'fond_poub'>";
				echo "<a href='http://localhost/Listes_courses/index.php?efface=" . $row['ID'] . "'>$poub</a>";
			echo "</TD>" ;
		
		echo "</TR>";	
		
		}
	
	echo "</TABLE>"	;
	echo "</br></br>";
	
//compte des produits

$count = count($produits);
echo "Nombre de produits : " . $count . "</br></br>";

}

//** fin partie tableau
//--------------------------------------------------------------------
//
//autres

/* //url d'envoi de la requête pour effacer une ligne
echo "<br>";
echo "<br>";
echo '<a href="http://localhost/Listes_courses/index.php?efface=">efface</a>';
echo "<br>";
echo "<br>";
 */



?>  
</html>
