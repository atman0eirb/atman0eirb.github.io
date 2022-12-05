<HTML>
	<HEAD>
	</HEAD>
	<BODY>
<?php
	//Version du 22 fevrier 2013
	//Fonction créer tableau JavaScript à partir d'une requete SQL
	
	//Définition des constantes
	define("SQLServerName","NomServeurmysqli");
	define("sqldbname","NomBaseDeDonnees");
	define("sqllogin","LoginSQL");
	define("sqlpass","MotDePasseSQL");

	function ConvertmysqliRequestToJavascriptArray($Resultat,$NomTableauJavaScript,$CreerBalisesJavaScript)
	{
		$CompteurChamp = 0;
        
		if ($CreerBalisesJavaScript == 1){
			echo "<script>";
            
		}
        
        
		echo "//Création du tableau JavaScript\n";
		echo $NomTableauJavaScript."=new Array();\n";
		echo "\n";
        
		
		//Création du tableau PHP qui va contenir les noms des champs de la requêtes SQL
        
		while ($CompteurChamp < mysqli_num_fields($Resultat)) {
            

			$meta = mysqli_fetch_field($Resultat);
			if (!$meta) {
				//echo "No information available<br />\n";
                
			}
			//echo "$meta->name<br />";
			$ChampsDeLaRequeteSQL[$CompteurChamp] = $meta->name;
			$CompteurChamp++;

		}
        echo "console.log(".$CompteurChamp.");";

		//Création des différents champs dans le tableau en JavaScript
		echo "//Création des différents champs du tableau JavaScript\n";
		$count = count($ChampsDeLaRequeteSQL);
		for ($CompteurChampsDeLaRequete = 0; $CompteurChampsDeLaRequete < $count; $CompteurChampsDeLaRequete++) {
			//echo $ChampsDeLaRequeteSQL[$CompteurChampsDeLaRequete]."\n";
			echo $NomTableauJavaScript."['".$ChampsDeLaRequeteSQL[$CompteurChampsDeLaRequete]."']=new Array();\n";
		}
		echo "\n";

		mysqli_data_seek($Resultat, 0); //On revient au début de l'enregistrement
		$CompteurResultats = 1; //Initialisation
		echo "//Copie des valeurs dans les différents champs du tableau JavaScript\n";
		while ($MaLigne=mysqli_fetch_array($Resultat, mysqli_ASSOC)){
			for ($CompteurChampsDeLaRequete = 0; $CompteurChampsDeLaRequete < $count; $CompteurChampsDeLaRequete++) {
				$onevalue = $MaLigne[$ChampsDeLaRequeteSQL[$CompteurChampsDeLaRequete]];
				if (mb_detect_encoding($onevalue, 'UTF-8', true) === false) {$onevalue = utf8_encode($onevalue);}
				echo $NomTableauJavaScript."['".$ChampsDeLaRequeteSQL[$CompteurChampsDeLaRequete]."'][".$CompteurResultats."] = \"".$onevalue."\";\n";
			}
			$CompteurResultats++;
		}

		if ($CreerBalisesJavaScript == 1){
			echo "</SCRIPT>\n";
		}		
	}
		
    $servername="localhost";
    $username="root";
    $password="";
    $db_name="GEST_PARKING";
    $MaConnection=mysqli_connect($servername,$username,$password,$db_name);
    
    if(!$MaConnection){
        die("Connexion �choue!".mysqli_connect_error($con));
    }	
    
    if ($MaConnection) {
		$sqlrequest = "SELECT * FROM PARKING";
		if (strlen($sqlrequest) > 0){
            $Resultat = mysqli_query($MaConnection, $sqlrequest, MYSQLI_STORE_RESULT);
			
            
			$num_rows = mysqli_num_rows($Resultat); //Récupération du nombre de lignes en réponse
            
			if ($num_rows > 0){ //Si on a des lignes en réponse
				ConvertmysqliRequestToJavascriptArray($Resultat,"TabSQL2JavaScript",1); //Appel de la fonction
			}
		}
		mysqli_free_result($Resultat);
		mysqli_close($MaConnection);
	}
	else{
		die('Connexion impossible : ' . mysqli_error());
	}
    echo "hello";

?>
	</BODY>
</HTML>