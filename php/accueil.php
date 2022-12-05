<?php 
	session_start();
	require("connexion.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../stats/style.css">
		<style>
			.entete  {
			border: 5px outset lightblue;
			background-color: lightblue;    
			text-align: center;
			}



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
			 div.gauche {float : left; width : 50%;}
			 div.droite {float : right; width : 50%;}
			 fieldset {margin:1px;padding: 0 0 1em 0; background:none;text-align:center;display:block;}
		</style>
	</head>
	<body>
	<?php session_start();
  if(!isset($_SESSION["username"])){
    header("Location: ../login.php");
  }
?>
<?php include('../template/header.php'); ?>
<div class="background">
		  <!--*********************************Liste de voitures qui se sont garées dans deux parkings différents au cours d'une journée***************************** -->
            <div class="gauche">

					<div >
					
					<p class="entete"> Liste de voitures qui se sont garées dans deux parkings différents au cours d'une journée</p>
					<?php
						$req="SELECT * FROM (VEHICULE  INNER JOIN 
						(select NUM_IMMATRICULE,NUM_PARKING  from STATIONNEMENT INNER JOIN PLACE USING (ID_PLACE) 
						WHERE DATE(STATIONNEMENT.HEURE_ENTREE) <= '2022-11-26' AND DATE(STATIONNEMENT.HEURE_SORTIE) >= '2022-11-26') 
						S1 USING (NUM_IMMATRICULE))
						CROSS JOIN (select NUM_IMMATRICULE,NUM_PARKING from STATIONNEMENT INNER JOIN PLACE USING (ID_PLACE) 
						WHERE DATE(STATIONNEMENT.HEURE_ENTREE) = '2022-11-26' AND DATE(STATIONNEMENT.HEURE_SORTIE) >= '2022-11-26') 
						S2       
						WHERE S2.NUM_PARKING!=S1.NUM_PARKING
						GROUP BY VEHICULE.NUM_IMMATRICULE
						HAVING COUNT(VEHICULE.NUM_IMMATRICULE)=2;";
						$result= mysqli_query($con,$req);
						$vehicules= mysqli_fetch_all($result);
					?>
					
						<table  class="table">
						<thead>
						<tr>
							<th>NUM_IMMATRICULE</th>
							<th>MARQUE</th>
							<th>DATE_MIS_CIRCULATION</th>
							<th>KILOMETRAGE</th>
							<th>ETAT</th>
						</tr>
						</thead>

						<tbody>
						<?php
							foreach($vehicules as $vehicule){ ?>
							<tr>
							<td><?php echo $vehicule[0]?></td>
							<td><?php echo $vehicule[1]?></td>
							<td><?php echo $vehicule[2]?></td>
							<td><?php echo $vehicule[3]?></td>
							<td><?php echo $vehicule[4]?></td>
						</tr>
						<?php }?>
						</tbody>
					</table>
				</div>
            </div>

			<!--********************************* le cout moyen du stationnement d'un véhicule par mois,***************************** -->
            <div class="droite white">

					<div >
					
					<p class="entete">  le cout moyen du stationnement d'un véhicule par mois </p>
					<?php
						$req="SELECT * FROM (VEHICULE  INNER JOIN 
						(select NUM_IMMATRICULE,NUM_PARKING  from STATIONNEMENT INNER JOIN PLACE USING (ID_PLACE) 
						WHERE DATE(STATIONNEMENT.HEURE_ENTREE) <= '2022-11-26' AND DATE(STATIONNEMENT.HEURE_SORTIE) >= '2022-11-26') 
						S1 USING (NUM_IMMATRICULE))
						CROSS JOIN (select NUM_IMMATRICULE,NUM_PARKING from STATIONNEMENT INNER JOIN PLACE USING (ID_PLACE) 
						WHERE DATE(STATIONNEMENT.HEURE_ENTREE) = '2022-11-26' AND DATE(STATIONNEMENT.HEURE_SORTIE) >= '2022-11-26') 
						S2       
						WHERE S2.NUM_PARKING!=S1.NUM_PARKING
						GROUP BY VEHICULE.NUM_IMMATRICULE
						HAVING COUNT(VEHICULE.NUM_IMMATRICULE)=2;";
						$result= mysqli_query($con,$req);
						$vehicules= mysqli_fetch_all($result);
					?>
					
						<table  class="table">
						<thead>
						<tr>
							<th>NUM_IMMATRICULE</th>
							<th>MARQUE</th>
							<th>DATE_MIS_CIRCULATION</th>
							<th>KILOMETRAGE</th>
							<th>ETAT</th>
						</tr>
						</thead>

						<tbody>
						<?php
							foreach($vehicules as $vehicule){ ?>
							<tr>
							<td><?php echo $vehicule[0]?></td>
							<td><?php echo $vehicule[1]?></td>
							<td><?php echo $vehicule[2]?></td>
							<td><?php echo $vehicule[3]?></td>
							<td><?php echo $vehicule[4]?></td>
						</tr>
						<?php }?>
						</tbody>
					</table>
				</div>
            </div>
  <!--*********************************Liste des parkings qui sont saturés à un moment donnée ***************************** -->
            <div class="float-child white">
					<div >
						<p class="entete">   Liste des parkings qui sont saturés à un moment donnée </p>
						<?php
							$req="SELECT pa.NUM_PARKING as pa, pa.CAPACITY as ca from PARKING pa
							INNER JOIN PLACE USING(NUM_PARKING)
							INNER JOIN STATIONNEMENT USING(ID_PLACE)
							WHERE DATE(STATIONNEMENT.HEURE_SORTIE)>='2022-11-26'
							AND DATE(STATIONNEMENT.HEURE_ENTREE)<='2022-11-26'
							AND TIME(STATIONNEMENT.HEURE_SORTIE)>='16:19:14'
							AND TIME(STATIONNEMENT.HEURE_ENTREE)<='16:19:14'
							GROUP BY pa.NUM_PARKING
							HAVING  COUNT(*) = (SELECT COUNT(*) FROM PLACE p 
												WHERE p.NUM_PARKING=pa.NUM_PARKING);  ";
								$result= mysqli_query($con,$req);
								$parkings= mysqli_fetch_all($result);
						?>
							<table class="table">
							<thead>
							<tr>
								<th>NUM_PARKING</th>
								<th>CAPACITY</th>
							</tr>
							</thead>

							<tbody>
							<?php
								foreach($parkings as $parking){ ?>
								<tr>
								<td><?php echo $parking[0]?></td>
								<td><?php echo $parking[1]?></td>
							</tr>
							<?php }?>
							</tbody>
						</table>
					</div>
			</div>
		</div>

<?php include('../template/footer.php'); ?>
	</body>
</html>