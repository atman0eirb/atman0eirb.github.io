

<?php 
	session_start();
	if(!isset($_SESSION["username"])){
		header("Location: ../../login.php");
	  }
?>
<!DOCTYPE html>
<html>
<?php include('../../template/header.php'); ?>

<?php
    require("../connexion.php");
    $query = "SELECT * FROM COMMUNE where CODE_POSTALE=33300";
    $result = mysqli_query($con,$query);
    $rows = mysqli_num_rows($result);
    if($rows!=1)
        echo "nothing to display";
    

    $commune = mysqli_fetch_assoc($result);
?>

<head>
<style>
.entete  {
  border: 5px outset lightblue;
  background-color: lightblue;    
  text-align: center;
}
 div.gauche {float : left; width : 50%;}
 div.droite {float : right; width : 50%;}
 fieldset {margin:1px;padding: 0 0 1em 0; background:none;text-align:center;display:block;}



.vide{
	
	text-align: center;
}

.id_stat{ 
  display: block;
  font-size: 1.5em;
  margin-top: 0.83em;
  margin-bottom: 0.83em;
  margin-left: 0;
  margin-right: 0;
  font-weight: bold;
}



</style>
<link rel="stylesheet" href="../../stats/style.css">
</head>
<body>

	
	

	
	<div class="background">
		  <!--********************************* Classement des communes les plus demandés par semaine ***************************** -->
		  <div class="gauche white">
									
				<div class="entete">
					<h5 class="description" > <b> Classement des communes les plus demandés par semaine</b></h5>
				</div>
				<?php 
					$query = "SELECT P.CODE_POSTALE as code_POSTALE,WEEKOFYEAR(S.HEURE_ENTREE) as semaine,ifnull(AVG(TIMESTAMPDIFF(MINUTE,S.HEURE_ENTREE,S.HEURE_SORTIE)) , '0') as AVG_MINUTE 
					FROM (PARKING P inner JOIN PLACE USING(NUM_PARKING)) 
					inner JOIN STATIONNEMENT S USING(ID_PLACE) 
					GROUP BY P.CODE_POSTALE ,2
					ORDER BY AVG_MINUTE DESC;";
					$result = mysqli_query($con,$query) ;
					$tabs=mysqli_fetch_all($result, MYSQLI_ASSOC);
				?>							
				<div class="white">
					<table class="table">
						<thead>
						<tr>
							<th>Code Postale</th>
							<th>Semaine</th>
							<th>Moyenne (minute)</th>
						</tr>
						</thead>

						<tbody>
							<?php
								foreach($tabs as $tab){ ?>
								<tr>
								<td><?php echo $tab['code_POSTALE'];?></td>
								<td><?php echo $tab['semaine'];?></td>
								<td><?php echo $tab['AVG_MINUTE'];?></td>
							
								</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
					
			</div>
            
  <!--********************************* Classement des parking les plus rentables par commune et par mois ***************************** -->
			<div class="droite white">
					
					<div class="entete">
						<h5 class="description" > <b> Classement des parking les plus rentables par commune et par mois</b></h5>
					</div>
					<?php 
						$query = "SELECT P.NUM_PARKING as np,P.CODE_POSTALE as cp,MONTH(S.HEURE_ENTREE) as mois, 
						ifnull(AVG(TIMESTAMPDIFF(MINUTE,S.HEURE_ENTREE,S.HEURE_SORTIE)/60*P.TARIF_HORAIRE) , '0') as Rentabilite  
						FROM (PARKING P inner JOIN PLACE USING(NUM_PARKING)) 
						inner JOIN STATIONNEMENT S USING(ID_PLACE) 
						GROUP BY P.NUM_PARKING,P.CODE_POSTALE,mois  
						ORDER BY `Rentabilite` DESC;";
						$result = mysqli_query($con,$query) ;
						$tabs=mysqli_fetch_all($result, MYSQLI_ASSOC);
					?>							
					<div class="white">
						<table class="table">
							<thead>
							<tr>
								<th>Numero Parking</th>
								<th>Code Postale</th>
								<th>Mois</th>
								<th>Rentabilite</th>
							</tr>
							</thead>
	
							<tbody>
								<?php
									foreach($tabs as $tab){ ?>
									<tr>
									<td><?php echo $tab['np'];?></td>
									<td><?php echo $tab['cp'];?></td>
									<td><?php echo $tab['mois'];?></td>
									<td><?php echo $tab['Rentabilite'];?></td>
								
									</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
						
				</div>
			  <!--********************************* Classement des parking les moins utilisés en terme de durée d'utilisation ***************************** -->

			  <div class="float-child white">
					
					<div class="entete">
						<h5 class="description" > <b> Classement des parking les moins utilisés en terme de durée d'utilisation</b></h5>
					</div>
					<?php 
						$query = "SELECT P.NUM_PARKING np,P.NOM_PARKING as nomP,P.CODE_POSTALE as cp,ifnull(AVG(TIMESTAMPDIFF(MINUTE,S.HEURE_ENTREE,S.HEURE_SORTIE)) , '0') as AVG_MINUTE  FROM (PARKING P LEFT JOIN PLACE USING(NUM_PARKING)) 
						LEFT JOIN STATIONNEMENT S USING(ID_PLACE) 
						GROUP BY P.NUM_PARKING,P.NOM_PARKING ,P.CODE_POSTALE
						ORDER BY AVG_MINUTE;";
						$result = mysqli_query($con,$query) ;
						$tabs=mysqli_fetch_all($result, MYSQLI_ASSOC);
					?>							
					<div class="white">
						<table class="table">
							<thead>
							<tr>
								<th>Numero Parking</th>
								<th>Nom Parking</th>
								<th>Code POSTALE</th>
								<th>Moyenne de minutes</th>

							</tr>
							</thead>
	
							<tbody>
								<?php
									foreach($tabs as $tab){ ?>
									<tr>
									<td><?php echo $tab['np'];?></td>
									<td><?php echo $tab['nomP'];?></td>
									<td><?php echo $tab['cp'];?></td>
									<td><?php echo $tab['AVG_MINUTE'];?></td>

								
									</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
						
				</div>
						  <!--********************************* Classement des parking les moins utilisés en terme du fréquence d'utilisation ***************************** -->

			<div class="float-child white">

				<div class="entete">
					<h5 class="description" > <b> Classement des parking les moins utilisés en terme du fréquence d'utilisation </b></h5>
				</div>
					<?php 
						$query = "SELECT P.NUM_PARKING as par,P.NOM_PARKING as nomP,P.CODE_POSTALE as cp,ifnull(COUNT(S.HEURE_ENTREE) , '0') as nb_utilisation  FROM (PARKING P LEFT JOIN PLACE USING(NUM_PARKING)) 
						LEFT JOIN STATIONNEMENT S USING(ID_PLACE) 
						GROUP BY P.NUM_PARKING,P.NOM_PARKING ,P.CODE_POSTALE
						ORDER BY nb_utilisation;";
						$result = mysqli_query($con,$query) ;
						$tabs=mysqli_fetch_all($result, MYSQLI_ASSOC);
					?>							
					<div class="white">
						<table class="table">
							<thead>
							<tr>
								<th>NUM_PARKING</th>
								<th>Nom Parking</th>
								<th>Code POSTALE</th>
								<th>Fréquence d'utilisation</th>
							</tr>
							</thead>

							<tbody>
								<?php
									foreach($tabs as $tab){ ?>
									<tr>
									<td><?php echo $tab['par'];?></td>
									<td><?php echo $tab['nomP'];?></td>
									<td><?php echo $tab['cp'];?></td>
									<td><?php echo $tab['nb_utilisation'];?></td>
								
									</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
			</div>
		</div>


       
            
	<!--<?php include('../../template/footer.php'); ?>-->

</html>
