<?php
//connexion à la base

	$bdd = new PDO('mysql:host=localhost;dbname=listes_courses;charset=utf8', 'root', 'root'); 

	$id = $_GET['calcul']; //obtention de la valeur de l'id pour connaitre les valeurs à calculer
	
	$id = intval($id); // forcage du format de $id en numerique (sécurité)

	/* echo $id ;
	die; */

// calcul et mise à jour du champ cout au clic sur la case valider

	$calcul = "SELECT prix_produit , quantite_produit FROM produits WHERE ID = {$id} " ; // création de la requête
	
	$req = $bdd->query($calcul ) ; //envoi de la requete
	
	$Tvaleurs = $req -> fetch() ; // récupération des valeurs nécessaires au calcul
	
	/* echo '<pre>';
	print_r($Tvaleurs); */
	
	$quantite_produit = $Tvaleurs['quantite_produit'] ; //obtention des valeurs
	
	$prix_produit = $Tvaleurs['prix_produit'] ;
	
	$cout = $quantite_produit * $prix_produit ; //calcul du cout total
	
	$total= "UPDATE produits SET total_produit = '$cout' , valider = 1 WHERE ID = {$id} " ; // création de l'update de la table avec le cout total
	
	$req2 = $bdd->query($total ) ; // envoi de la requête
	
	header('Location: ./index.php');// rechargement de la page index.php sans afficher function.php
	
//fin calcul et mise à jour du champ cout au clic sur la case valider
//----------------------------------------------------------------------------------------------------

?>