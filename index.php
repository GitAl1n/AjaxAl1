<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">

	<title>Liste</title>
	
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	
	
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/popper.js" type="text/javascript"></script>
	<script src="js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="js/jbootstrap.min.js" type="text/javascript"></script>
	<script src="js/function.js" type="text/javascript"></script>
	
	
</head>

<body>

<?php
echo "<section class ='fond'>";
//include 'function.php';


//**partie connection

// On vérifie que le nom de base de données correspond, mais également le nom d'utilisateur et mot de passe

require_once('./connexion.php');

//OU :
//$bdd = new PDO('mysql:host=localhost;dbname=formation;charset=utf8', 'root', 'root');

//**fin partie connection
//---------------------------------------------------------------
//**partie gestion des lignes (supprimer...

//création de la requête pour effacer

if (isset($_GET['efface_id_produit'])) { // OU : if (isset($_GET['efface_id_produit']) and $_GET['efface_id_produit'] != '' ){
	
	$produit_a_effacer = intval($_GET['efface_id_produit']);//force un champ de type INT

	$requete_produits = "DELETE FROM produits WHERE ID = $produit_a_effacer ";
	
	//echo "<br> effacer le produit : $produit_a_effacer <br>";
	
		if(!$bdd->query($requete_produits)){
			
		print_r($bdd->errorInfo());
		}
}else{
	echo "Pas de produit à effacer." ;
}

//création de la requête pour ajouter si clique sur plus +

if (isset($_GET['plus'])) {
	
	$id = intval(trim($_GET['plus']));
	
	$quantite_initiale = 0 ;
	
	if (isset($_GET['quantite'])) {
		
		$quantite_initiale = intval($_GET['quantite']);
	}
	$nouvelle_valeur = $quantite_initiale + 1;

	$requete_update = "UPDATE produits SET quantite_produit = $nouvelle_valeur WHERE ID = $id";
		
		if(!$bdd->query($requete_update)) { // On execute la requete
			
			echo($bdd->errorInfo()[2]); // si erreur, on affiche l'erreur
		}
}

//création de la requête pour mise a jour de la quantite si clique sur moins -

if (isset($_GET['moins'])) {
	
	$id = intval(trim($_GET['moins']));
	
	// Gestion de la quantite
	
	$quantite_initiale=0;
	
	if (isset($_GET['quantite'])) {
		
		$quantite_initiale = intval($_GET['quantite']);
		
	}
	
	$nouvelle_quantite = $quantite_initiale - 1;

	$nouvelle_valeur = $nouvelle_quantite;

	if ($nouvelle_quantite >= 0) {
		
		$requete_update = "UPDATE produits SET quantite_produit = $nouvelle_valeur WHERE ID = $id";
		
		if(!$bdd->query($requete_update)) { // On execute la requete
			
			echo($bdd->errorInfo()[2]); // si erreur, on affiche l'erreur
		
		}
	
	}

}
//** fin partie gestion des lignes
//------------------------------------------------------------------
//** partie tableau : affichage des produits

echo "<h2>Tableau 'Liste de courses'</h2>";

//récupération des produits et de leur quantité

$requete = "SELECT * FROM produits";

if ($req_produits = $bdd->query($requete)) {
	$produits = $req_produits->fetchAll();
	

	
//initialisation du tableau
	
	echo "<TABLE BORDER CELLPADDING=10 CELLSPACING=0>";
		
		echo "<TR class = 'fond_noir font_white'>";
			echo "<TH >Nom produit</TH> <TH>Quantité</TH> <TH>Prix</TH><TH>Coût</TH><TH>Valider</TH><TH>Enlever / Ajouter</TH><TH>Supprimer</TH>";
		echo "</TR>";	
	
//calcul des lignes	
		
			foreach  ($produits as $row) {

	//creation d'une variable id

	$id = $row['ID'];

	//création d'une variable pour les quantités

	$qte = $row['quantite_produit'];

	//création d'une variable poubelle pour icone

	$poub = "<i class='fa fa-trash-o' aria-hidden='false'></i>";
	//$chekbox = "<i class='fa fa-square-o ' aria-hidden='false'></i>";
	
	//création d'une variable pour  icone plus

	$plus= "<i class='fa fa-plus' aria-hidden='false'></i>";

	//création d'une variable pour icone moins

	$moins = "<i class='fa fa-minus red_color' aria-hidden='false' ></i>";
	
	//création d'une variable chekbox pour icone

	$checkbox = "<i class='fa fa-check-square-o' aria-hidden='true'></i>" ;
	"<i class='fa fa-square-o' aria-hidden='true'></i>" ;

	
	//création d'une variable pour le total
	
	$cout = 0 ;

		
	//affichage du tableau
			
			echo "<TR class = 'centrer'>";
				
				echo "<TD class = 'fond_bleu'>";
					echo $row['nom_produit'] ;
				echo"</TD>" ;
				
				echo "<TD class = 'fond_bleu'>";
					echo $row['quantite_produit'] ;
				echo"</TD>" ;
				
				echo "<TD class = 'fond_bleu'>";
					echo $row['prix_produit'] ; 
				echo"</TD>" ;
				
				echo "<TD class = 'fond_bleu'>";
					echo $row['total_produit'] ;
				echo"</TD>" ;
				
				echo "<TD class = 'fond_bleu'>";
					echo "<a href = 'function.php?calcul={$id}' type = 'hidden'>$checkbox</a>" ;
				echo"</TD>" ;
				
				echo "<TD class = 'fond_bleu'>";//boutons plus et moins
					echo "<a href='http://localhost/Listes_courses/index.php?moins={$id}&quantite={$qte}' > " . $moins ."</a>" . ' / ' . "<a href='http://localhost/Listes_courses/index.php?plus={$id}&quantite={$qte}'>" . $plus ." </a>";
				echo "</TD>" ;
				
				echo "<TD class = 'fond_noir'>";
					echo "<a href='http://localhost/Listes_courses/index.php?efface_id_produit=" . $id . "'>$poub</a>";
				echo "</TD>" ;
			
			echo "</TR>";	
			
			}
		
		echo "</TABLE>"	;
		echo "</br></br>";
	
//compte des produits

$count = count($produits);
echo "Nombre de produits : " . $count . "</br></br>";

//produits effacés

echo "<br>  Le produit : $produit_a_effacer est effacé.<br>";

}

//** fin partie tableau
//--------------------------------------------------------------------
//


echo "</section>";
?>  
</body>
</html>
