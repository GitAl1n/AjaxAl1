<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">

	<title>Liste</title>
	
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css" type="text/css" />

</head>
<body>
<div class = container-fluid>
<?php

//echo 'GET :  ' ;
echo "<br><br>";
$Tentrees = ['toto', 'titi', 'tata' ];
var_dump ($Tentrees);

// test de chaque parametre de Tentrees en get et en post, affectation de sa valeur à chaque boucle
foreach ($Tentrees as $a_tester){
	
	if (isset($_GET[$a_tester])){
		$$a_tester = $_GET[$a_tester]. "<br><br>";
		}

	elseif (isset($_POST[$a_tester])){
		$$a_tester = $_POST[$a_tester]. "<br><br>";
		}

	else{
		$$a_tester = false;
		echo ('pas de paramètre '). $a_tester . "<br><br>";
		}
}

/* if ($toto){
	echo "<br><br>" . 'toto existe'. "<br><br>";
}

else{
	echo 'toto n\'existe pas'. "<br><br>";
}
 */
?>

echo "<form action = "test_envoi.php" method = "post">";
echo "<br><br>";
<input type= "text" name = toto value = '' placeholder = 'toto'/>
echo "<br><br>";
<input type= "text" name = titi value = '' placeholder = 'titi'/>
echo "<br><br>";
<input type= "text" name = tata value = '' placeholder = 'tata'/>
echo "<br><br>";
<input type= "text" name = tutu value = '' placeholder = 'tutu'/>
echo "<br><br>";
<input type = "submit" value = 'Envoyer' />
echo "<br><br>";
echo "</form>";

</div>
<div class = container-fluid id="deux">
<?php

//tableau de présentation des paramètres et des valeurs

echo "<TABLE BORDER CELLPADDING=10 CELLSPACING=0>";
		
		echo "<tr class = 'fond_th'>";
			echo "<th >Parametre</th> <th>Valeur</th>";
		echo "</tr>";	
	
//calcul des lignes	
		
foreach  ($Tentrees as $a_tester){
		
//affichage du tableau
		
		echo "<tr class = 'centrer'>";
			
			echo "<td >";
				echo ($a_tester) ;
			echo"</td>" ;
			
			echo "<td >";
				echo ($$a_tester) ;
			echo"</td>" ;
			
		
		echo "</tr>";		
}
 
?>
</div>


</html>
